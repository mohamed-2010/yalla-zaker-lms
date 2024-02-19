<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::latest()->paginate(10);
        return view('dashboard.teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $subjects = Subject::get();
        return view('dashboard.teachers.create', compact('subjects'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90','unique:teachers'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'phone' => ['required','unique:teachers'],
            'subject_ids' => ['required'],
        ]);
        
        $Teacher = new Teacher;
        $Teacher->name = $request->name;
        $Teacher->bio = $request->bio ?? '';
        $Teacher->insta_url = $request->insta_url ?? '';
        $Teacher->fb_url = $request->fb_url ?? '';
        $Teacher->yt_url = $request->yt_url ?? '';
        $Teacher->tk_url = $request->tk_url ?? '';
        $Teacher->whatsapp_1 = $request->whatsapp_phone_1 ?? '';
        $Teacher->whatsapp_2 = $request->whatsapp_phone_2 ?? '';
        $Teacher->whatsapp_3 = $request->whatsapp_phone_3 ?? '';
        $Teacher->email = $request->email ?? ''; 
        $Teacher->phone = $request->phone ?? '';
        $Teacher->show_in_index = $request->show_in_index ?? false;
        $Teacher->password = Hash::make($request->password);

        if($request->hasFile('image')) {
            $Teacher->addMedia($request->file('image'))->toMediaCollection('teachers');
        }

        
        if($request->hasFile('cover')) {
            $Teacher->addMedia($request->file('cover'))->toMediaCollection('teachers_cover');
        }

        $Teacher->save();

        $Teacher->assignRole('teacher');

        $Teacher->subjects()->sync($request->subject_ids);


        return redirect()->route('dashboard.teachers.index')->with('success', 'تم اضافة المدرس بناجح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Teacher = Teacher::findOrfail($id);
        return view('dashboard.teachers.show', ['Teacher' => $Teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $Teacher = Teacher::findOrfail($id);
        $subjects = Subject::get();

        return view('dashboard.teachers.edit', [
            'Teacher' => $Teacher,
            'subjects' => $subjects,

        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Teacher = Teacher::findOrfail($id);
        $request->validate([
            'name' => ['required', 'string', 'max:90'],
            'email' => ['required', 'string', 'email', 'max:90', 'unique:teachers,email,' .$id],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
            'phone' => ['required', 'unique:teachers,phone,' .$id],
            'subject_ids' => ['required'],


        ]);
        $Teacher = Teacher::findOrfail($id);
        $Teacher->name = $request->name;
        $Teacher->bio = $request->bio ?? '';
        $Teacher->insta_url = $request->insta_url ?? '';
        $Teacher->fb_url = $request->fb_url ?? '';
        $Teacher->yt_url = $request->yt_url ?? '';
        $Teacher->tk_url = $request->tk_url ?? '';
        $Teacher->whatsapp_1 = $request->whatsapp_phone_1 ?? '';
        $Teacher->whatsapp_2 = $request->whatsapp_phone_2 ?? '';
        $Teacher->whatsapp_3 = $request->whatsapp_phone_3 ?? '';
        $Teacher->email = $request->email ?? '';
        $Teacher->phone = $request->phone ?? '';
        $Teacher->show_in_index = $request->show_in_index ?? false;

        if ($request->password != null) {
            $Teacher->password = Hash::make($request->password);
        }

        if($request->hasFile('image')) {
            $Teacher->clearMediaCollection('teachers');
            $Teacher->addMedia($request->file('image'))->toMediaCollection('teachers');
        }

        if($request->hasFile('cover')) {
            $Teacher->clearMediaCollection('teachers_cover');
            $Teacher->addMedia($request->file('cover'))->toMediaCollection('teachers_cover');
        }

        $Teacher->save();

        $Teacher->subjects()->sync($request->subject_ids);

        return redirect()->route('dashboard.teachers.index')->with('success', 'تم تعديل بيانات المدرس بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Teacher = Teacher::findOrfail($id);
        $Teacher->clearMediaCollection('teachers');
        $Teacher->delete();
        return redirect()->route('dashboard.teachers.index')->with('success', 'تم حذف المدرس بنجاح');
    }

    public function account_status_update($id, $status)
    {
        $Teacher = Teacher::findOrfail($id);
        if ($status == 'activated') {
            $Teacher->account_status = 'activated';
        }
        if ($status == 'ban') {
            $Teacher->account_status = 'ban';
        }
        $Teacher->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الحساب بنجاح');
    }
}
