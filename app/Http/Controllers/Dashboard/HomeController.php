<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CouponeCode;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\RecordedLesson;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $analytics = [
                [
                    'name' => 'الصفوف الدراسية',
                    'count' => count(Grade::all())
                ],
                [
                    'name' => 'المواد الدراسية',
                    'count' => count(Subject::all())
                ],
                [
                    'name' => 'المدرسين',
                    'count' => count(Teacher::all())
                ],
                [
                    'name' => 'جميع الطلاب',
                    'count' => count(User::all())
                ],
                [
                    'name' => 'الطلاب المحظورين',
                    'count' => count(User::where('account_status', 'ban')->get())
                ],
                [
                    'name' => 'الدروس',
                    'count' => count(RecordedLesson::all())
                ],
                [
                    'name' => 'الامتحانات',
                    'count' => count(Exam::all())
                ],
                [
                    'name' => 'الاكواد',
                    'count' => count(CouponeCode::all())
                ],
            ];
    
            return view('dashboard.home', compact('analytics'));
        }else{
            $user_id = Auth::user()->id;
            $analytics = [
                [
                    'name' => 'المواد الدراسية',
                    'count' => count(Auth::user()->subjects ?? [])
                ],
                [
                    'name' => 'الدروس',
                    'count' => count(RecordedLesson::where('teacher_id', $user_id)->get())
                ],
                [
                    'name' => 'الامتحانات',
                    'count' => count(Exam::where('teacher_id', $user_id)->get())
                ],
                [
                    'name' => 'الاكواد',
                    'count' => count(CouponeCode::where('teacher_id', $user_id)->get())
                ],
            ];
    
            return view('dashboard.home', compact('analytics'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
