<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CouponeCode;
use App\Models\CouponeCodeVideo;
use App\Models\RecordedLesson;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CouponeCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->hasRole('admin')) {
            $couponCodes = CouponeCode::get();
            return view('dashboard.coupon_codes.index', compact('couponCodes'));
        }else{
            $couponCodes = CouponeCode::where('teacher_id', Auth::user()->id)->get();
            return view('dashboard.coupon_codes.index', compact('couponCodes'));
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::with('recordedLessons')->get();
        return view('dashboard.coupon_codes.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'count_of_days' => 'required|integer',
            'count_of_views' => 'required|integer',
            'count' => 'required|integer',
            'video_count' => 'required|integer',
            'first_code_stage' => 'required',
            // 'video_ids' => 'required|array', // Validate video_ids as an array
            // 'video_ids.*' => 'exists:videos,id' // Each video ID must exist in the videos table
        ]);
    
        $coupons = [];
        for ($i = 0; $i < $request->count; $i++) {
            $code = Str::random(6);
            $coupon = CouponeCode::create([
                'teacher_id' => Auth::user()->hasRole('admin') ? $request->teacher_id : Auth::user()->id,
                'count_of_days' => $request->count_of_days,
                'count_of_views' => $request->count_of_views,
                'video_count' => $request->video_count,
                'code' => $request->first_code_stage . $code,
            ]);
    
            // Associate each video ID with the created coupon
            foreach ($request->video_ids as $videoId) {
                CouponeCodeVideo::create([
                    'coupone_code_id' => $coupon->id, // Use the ID of the coupon just created
                    'recorded_lesson_id' => $videoId // The video ID from the request
                ]);
            }
    
            $coupons[] = $coupon;
        }
    
        return redirect()->back()->with('success', "تم اضافة الاكواد بنجاح");
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $couponeCode = CouponeCode::findOrfill($id);
        $couponeCode->load('videos');
        return view('dashboard.coupon_codes.show', compact('couponeCode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CouponeCode $couponeCode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CouponeCode $couponeCode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CouponeCode $couponeCode)
    {
        //
    }
}
