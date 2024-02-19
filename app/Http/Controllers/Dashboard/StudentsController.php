<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Government;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\StudentSession;
use Exception;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function student_sessions($id)
    {
        $sessions = StudentSession::where('user_id', $id)->latest()->paginate(10);
        return view('dashboard.students.sessions', ['sessions' => $sessions]);
    }

    public function index()
    {
        $students = User::latest()->paginate(10);
        return view('dashboard.students.index', ['students' => $students]);
    }

    public function new()
    {
        $students = User::where('account_status', 'new')->latest()->paginate(10);
        return view('dashboard.students.index', ['students' => $students]);
    }

    public function ban()
    {
        $students = User::where('account_status', 'ban')->latest()->paginate(10);
        return view('dashboard.students.index', ['students' => $students]);
    }

    public function did_not_join_any_group()
    {
        $students = User::has('groups')->latest()->paginate(10);
        return view('dashboard.students.index', ['students' => $students]);
    }

    public function find(Request $r)
    {

        $students = User::where('phone', 'like', "%$r->text%")
        ->orWhere('name', 'like', "%$r->text%")
        ->paginate(10);
        return view('dashboard.students.index', ['students' => $students, 'text' => $r->text]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        try {
            $r->validate([
                'name' => ['required', 'string'],

                // 'email' => ['required', 'string', 'email', 'max:90','unique:users'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'phone' => ['required','unique:users'],

            ]);
            $student = new User;
            $student->email = $r->email;
            $student->name = $r->name;

            // $student->email = $r->email;
            $student->phone = $r->phone;

            $student->password = Hash::make($r->password);
            $student->save();

            return redirect()->route('dashboard.students.index')->with('success', 'تم اضافة الطالب بناجح');
        }catch(Exception $e) {
            return redirect()->back()->withInput($r->all())->with('error', $e->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::findOrfail($id);
        return view('dashboard.students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = User::findOrfail($id);
        $governments = Government::with('areas')->get();
        return view('dashboard.students.edit', [
            'student' => $student,
            'governments' => $governments
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
        $student = User::findOrfail($id);
        $r->validate([
            'name' => ['required', 'string'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'unique:users,phone,' .$id],
        ]);
        $student = User::findOrfail($id);
        $student->name = $r->name;
        $student->phone = $r->phone;

        if ($r->password != null) {
            $student->password = Hash::make($r->password);
        }
        $student->save();
        $student->groups()->sync($r->groups);

        return redirect()->route('dashboard.students.index')->with('success', 'تم تعديل بيانات الطالب بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Student = User::findOrfail($id);
        if (file_exists(public_path() . '/storage/students' . '/' . $Student->image)) {
            Storage::delete('public/students' . '/' . $Student->image);
        }
        $Student->delete();
        return redirect()->route('dashboard.students.index')->with('success', 'تم حذف الطالب بنجاح');
    }


    // Start wallet

    public function addwalletView($id)
    {
        $student = User::findOrfail($id);
        return view('dashboard.students.add_wallet', ['student' => $student]);

    }


    public function addwallet(Request $r)
    {
        $r->validate([
            'student_id' => ['required', 'string'],
            'wallet' => 'required', 'number',

        ]);
        $student = User::findOrfail($r->student_id);
        $student->wallet = $student->wallet + $r->wallet;
        $student->save();


        $Notification = new Notification;
        $Notification->title = "تم اضافة رصيد لحسابك";
        $Notification->desc = 'تم اضافة ' . $r->wallet . ' نقطة الى حسابك';
        $Notification->type = 3;
        $Notification->user_id = $r->student_id;
        $Notification->save();

        return redirect()->route('dashboard.students.index')->with('success', 'تم اضافة الرصيد بنجاح');
    }


    public function editwalletView($id)
    {
        $student = User::findOrfail($id);
        return view('dashboard.students.edit_wallet', ['student' => $student]);

    }

    public function editwallet(Request $r)
    {
        $r->validate([
            'student_id' => ['required', 'string'],
            'wallet' => 'required', 'number',

        ]);
        $student = User::findOrfail($r->student_id);
        $student->wallet = $r->wallet;
        $student->save();


        $Notification = new Notification;
        $Notification->title = "تم تعديل رصيد لحسابك";
        $Notification->desc = 'رصيد حسابك: ' . $r->wallet;
        $Notification->type = 3;
        $Notification->user_id = $r->student_id;
        $Notification->save();

        return redirect()->route('dashboard.students.index')->with('success', 'تم تعديل الرصيد بنجاح');
    }

    // End wallet

    public function account_status_update($id, $status)
    {
        $student = User::findOrfail($id);
        if ($status == 'active') {
            $student->account_status = 'active';
        }
        if ($status == 'ban') {
            $student->account_status = 'ban';
        }
        $student->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الحساب بنجاح');
    }

}
