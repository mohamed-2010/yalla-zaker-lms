<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\RecordedLesson;
use App\Models\Subject;
use App\Models\Teacher;
use App\ThirdPartyApi\BunnyCdn\BunnyAPI;
use App\ThirdPartyApi\BunnyCdn\BunnyAPIStream;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;

class RecordedLessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $role = Role::where('name', 'teacher')->get();
        // $
        // $role->givePermissionTo($permission);
        // return dd($role);
        if(Auth::user()->hasRole('admin')) {
            $lessons = RecordedLesson::get();
        } else {
            $lessons = RecordedLesson::where('teacher_id', Auth::user()->id)->get();
        }
        return view('dashboard.recorded_lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::get();
        $teachers = Teacher::with(['subjects', 'subjects.grade'])->get();
        $subjects = Subject::with(['teachers', 'exams', 'grade'])->where('active', true)->get();
        // return dd($subjects);

        return view('dashboard.recorded_lessons.create', compact(['exams', 'teachers', 'subjects']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'video' => ['nullable','mimes:mp4,mov,ogg','max:1000000'],
        //     'cover' => ['nullable', 'image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        // ]);

        try {
            $RecordedLesson = new RecordedLesson;
            $RecordedLesson->exam_id = $request->exam_id;
            $RecordedLesson->teacher_id = $request->teacher_id;
            $RecordedLesson->subject_id = $request->subject_id;
            $RecordedLesson->name = $request->title;
            $RecordedLesson->type = $request->type;
            $RecordedLesson->is_paid = $request->is_paid == "true" ? 1 : 0;
            $RecordedLesson->price = $request->price;
            $RecordedLesson->video_library_id = "205675";
            if ($request->hasFile('cover')) {
                $RecordedLesson->addMedia($request->file('cover'))->toMediaCollection('lessons');
            }
            if ($request->hasFile('atachment')) {
                $RecordedLesson->addMedia($request->file('atachment'))->toMediaCollection('lessons');
            }
            $RecordedLesson->save();
            $bunny = new BunnyAPIStream();
            // $client = new Client();
            $bunny->streamLibraryAccessKey('ca900a0e-8912-4c55-8e76167e3b7b-28f8-47ed');
            $bunny->setStreamLibraryId("205675");
            $video_guid = $bunny->createVideo($request->title);
            $RecordedLesson->video_id = $video_guid['guid'];
            $RecordedLesson->save();
            $client = new Client();
            $videoPath = $request->video; // Make sure this is the correct path to your video file

            // Open a file stream
            $videoStream = fopen($videoPath, 'r');

            $video_upload = $client->request('PUT', 'https://video.bunnycdn.com/library/205675/videos/'.$video_guid['guid'], [
                'headers' => [
                    'AccessKey' => 'ca900a0e-8912-4c55-8e76167e3b7b-28f8-47ed',
                    'accept' => 'application/json',
                ],
                'body' => $videoStream // Pass the stream as the body
            ]);

            // Don't forget to close the stream if you're done with it
            if (is_resource($videoStream)) {
                fclose($videoStream);
            }
            $bunny->uploadVideo($video_guid['guid'], $request->video);
            $bunny->setThumbnail($video_guid['guid'], $RecordedLesson->getFirstMedia('lessons')->getUrl());
            return redirect()->route('dashboard.recorded-lessons.index')->with('success', 'تم اضافة الدرس بنجاح');
        }catch(Exception $e) {
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(RecordedLesson $recordedLesson)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $RecordedLesson = RecordedLesson::with(['subject', 'subject.exams'])->findOrfail($id);
        $exams = Exam::get();
        $teachers = Teacher::with(['subjects', 'subjects.grade'])->get();
        $subjects = Subject::with(['teachers', 'exams', 'grade'])->where('active', true)->get();
        return view('dashboard.recorded_lessons.edit', compact(['RecordedLesson', 'exams', 'subjects', 'teachers']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'video' => ['nullable','mimes:mp4,mov,ogg','max:1000000'],
            'cover' => ['nullable', 'image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        try {
            $RecordedLesson = RecordedLesson::findOrfail($id);
            $RecordedLesson->exam_id = $request->exam_id;
            $RecordedLesson->teacher_id = $request->teacher_id;
            $RecordedLesson->subject_id = $request->subject_id;
            $RecordedLesson->name = $request->title;
            $RecordedLesson->type = $request->type;
            $RecordedLesson->is_paid = $request->is_paid == "true" ? 1 : 0;
            $RecordedLesson->price = $request->price;
            $RecordedLesson->video_library_id = "ca900a0e-8912-4c55-8e76167e3b7b-28f8-47ed";
            if ($request->hasFile('cover')) {
                $RecordedLesson->clearMediaCollection('lessons');
                $RecordedLesson->addMedia($request->file('cover'))->toMediaCollection('lessons');
            }
            if ($request->hasFile('atachment')) {
                $RecordedLesson->clearMediaCollection('lessons');
                $RecordedLesson->addMedia($request->file('atachment'))->toMediaCollection('lessons');
            }
            $RecordedLesson->save();
            if($request->hasFile('video')) {
                $bunny = new BunnyAPIStream();
                // $client = new Client();
                $bunny->streamLibraryAccessKey('ca900a0e-8912-4c55-8e76167e3b7b-28f8-47ed');
                $bunny->setStreamLibraryId("205675");
                $video_guid = $bunny->createVideo($request->title);
                $RecordedLesson->video_id = $video_guid['guid'];
                $RecordedLesson->save();
                $client = new Client();
                $videoPath = $request->video; // Make sure this is the correct path to your video file

                // Open a file stream
                $videoStream = fopen($videoPath, 'r');

                $video_upload = $client->request('PUT', 'https://video.bunnycdn.com/library/205675/videos/'.$video_guid['guid'], [
                    'headers' => [
                        'AccessKey' => 'ca900a0e-8912-4c55-8e76167e3b7b-28f8-47ed',
                        'accept' => 'application/json',
                    ],
                    'body' => $videoStream // Pass the stream as the body
                ]);

                // Don't forget to close the stream if you're done with it
                if (is_resource($videoStream)) {
                    fclose($videoStream);
                }
                $bunny->uploadVideo($video_guid['guid'], $request->video);
                $bunny->setThumbnail($video_guid['guid'], $RecordedLesson->getFirstMedia('lessons')->getUrl());
            }
            return redirect()->route('dashboard.recorded-lessons.index')->with('success', 'تم تحديث بيانات الدرس بنجاح');
        }catch(Exception $e) {
            Log::alert($e);
            return redirect()->back()->with('error', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $RecordedLesson = RecordedLesson::findOrfail($id);
        $RecordedLesson->clearMediaCollection('lessons');
        $RecordedLesson->delete();
        
        return redirect()->back()->with('success', 'تم حذف الدرس بناجح');
    }
}
