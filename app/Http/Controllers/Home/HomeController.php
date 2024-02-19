<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Government;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Crypt;
use Mockery\Matcher\Subset;

class HomeController extends Controller {

    public function index() {
        $subjects = Subject::with('teachers')->where('active', 1)
        //get first 3 subjects
        ->take(3)->get();
        $grades = Grade::get();
        $teachers = Teacher::with('subjects')->get();
        return view('welcome', compact('subjects', 'grades', 'teachers'));
    }

    public function get_subjects_with_grade($grade_id) {
        $grade_id = Crypt::decrypt($grade_id);
        $grade = Grade::find($grade_id);
        $subjects = Subject::where('grade_id', $grade_id)
        ->where('active', 1)
        ->get();

        return view('student.subject.list_with_grade', compact('subjects', 'grade'));
    }

    public function subject_details($id) {
        $id = Crypt::decrypt($id);
        $subject = Subject::findOrfail($id);
        return view('student.subject.details', compact('subject'));
    }

    public function teacher_details($id) {
        $id = Crypt::decrypt($id);
        $teacher = Teacher::findOrfail($id);
        return view('student.teacher.details', compact('teacher'));
    }

    public function sigin() {
        return view('student.auth.signin');
    }

    public function signup() {
        $governments = Government::with('areas')->get();
        return view('student.auth.signup', compact('governments'));
    }

    public function get_teacher_subject_lessons($subject_id, $teacher_id)
    {
        $teacher_id = Crypt::decrypt($teacher_id);
        $subject_id = Crypt::decrypt($subject_id);

        $subject = Subject::with(['recordedLessons' => function ($query) use ($teacher_id) {
            $query->where('teacher_id', $teacher_id);
        }])->find($subject_id);
        $teacher = Teacher::find($teacher_id);
    
        return view('student.subject.details', compact('subject', 'teacher'));
    }

    public function get_teachers_in_subject($subject_id) {
        $subject_id = Crypt::decrypt($subject_id);
        $subject = Subject::find($subject_id);
        $teachers = $subject->teachers;
        return view('student.subject.teachers', compact('subject', 'teachers'));
    }

}