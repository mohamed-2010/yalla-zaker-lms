<?php

namespace App\Http\Controllers\Student\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\StudentSession;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller {

    public function index() {
        $authed_devices = StudentSession::where('user_id', Auth::user()->id)->get()->count();
        $available_videos = 0;
        $wallet_balance = 0;

        return view('student.dashboard.index', compact('authed_devices', 'available_videos', 'wallet_balance'));
    }

    public function profile() {
        return view('student.dashboard.profile');
    }

    public function settings() {
        return view('student.dashboard.settings');
    }

    public function update_account(Request $request) {
        try {

            $user = User::find(Auth::user()->id);
            if ($request->name !== null) {
                $user->name = $request->name;
            }

            if ($request->email !== null) {
                $user->email = $request->email;
            }

            if ($request->area !== null) {
                $user->area_id = $request->area;
            }

            if ($request->phone !== null) {
                $user->phone = $request->phone;
            }

            if ($request->parent_phone !== null) {
                $user->parent_phone = $request->parent_phone;
            }

            if ($request->government !== null) {
                $user->government_id = $request->government;
            }

            // $user->attend_type = $request->attend_type;

            if ($request->password !== null) {
                $user->password = Hash::make($request->password);
            }

            if($request->hasFile('cover')) {
                $user->clearMediaCollection('students_cover');
                $user->addMedia($request->file('cover'))->toMediaCollection('students_cover');
            }

            if($request->hasFile('icon')) {
                $user->clearMediaCollection('students');
                $user->addMedia($request->file('icon'))->toMediaCollection('students');
            }
            
            $user->save();

            return redirect()->back()->with('success', 'تم تعديل الحساب بنجاح');

        }catch(Exception $e) {
            return redirect()->back()->with('error', 'الرجاء المحاوله مره اخري');
        }
    }

}