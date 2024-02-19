<?php

namespace App\Http\Controllers\Dashboard\Exams;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;

class ExamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $exams = Exam::orderBy('id', 'DESC')->get();
        }else{
            $exams = Exam::orderBy('id', 'DESC')->where('teacher_id', Auth::user()->id)->get();
        }
        return view('dashboard.exams.periodic_exams.index', ['exams' => $exams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = Subject::where('active', true)->get();
        $teachers = Teacher::with(['subjects', 'subjects.grade'])->get();

        return view('dashboard.exams.periodic_exams.create', [
            'subjects' => $subjects,
            'teachers' => $teachers

        ]);
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
            'time' => ['required'],
            'name' => ['required'],
            'subject_id' => ['required']
        ]);
        $exam = new Exam;
        $exam->duration = $request->time;
        $exam->name = $request->name;
        $exam->subject_id = $request->subject_id;
        $exam->teacher_id = $request->teacher_id;
        $exam->save();
        
        return redirect()->route('dashboard.exams.index')->with('success', 'تم اضافة الامتحان بناجح');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exam = Exam::findOrfail($id);
        $teachers = Teacher::get();
        $subjects = Subject::with('teachers')->where('active', true)->get();

        return view('dashboard.exams.periodic_exams.edit', [
            'exam' => $exam, 
            'subjects' => $subjects,
            'teachers' => $teachers

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
        $request->validate([
            'time' => ['required'],
            'name' => ['required'],
            'subject_id' => ['required']
        ]);
        $exam = Exam::findOrfail($id);
        $exam->duration = $request->time;
        $exam->name = $request->name;
        $exam->subject_id = $request->subject_id;
        $exam->teacher_id = $request->teacher_id;
        $exam->save();

        return redirect()->back()->with('success', 'تم تحديث بيانات الامتحان بناجح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::findOrfail($id);
        $exam->delete();
        return redirect()->route(Auth::user()->hasRole('admin') ? 'dashboard.exams.index' : 'dashboard.teacher.exams.index')->with('success', 'تم حذف الامتحان بناجح');
    }

    public function answers($id)
    {
        $exam = Exam::findOrfail($id);
        if ($exam == null) {
            return redirect()->back()->with('error', 'هذا الامتحان غير متاح');
        }
        return view('dashboard.exams.periodic_exams.answers', ['exam' => $exam]);
    }
}
