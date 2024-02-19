<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller {

    public function index() {
        $user = Auth::user();
        return view('profile.index', compact('user'));
    }

    public function update_admin(Request $request) {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:admins,email,' . Auth::user()->id,
        //     'password' => 'sometimes|nullable|min:6|confirmed',
        // ]);
    
        $admin = Admin::find(Auth::user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        
        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        
        $admin->save();
    
        return back()->with('success', 'تم تحديث الحساب بنجاح');
    }

    public function update_teacher(Request $request) {
        // $request->validate([
        //     'teacher_id' => 'required|exists:teachers,id',
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:teachers,email,' . Auth::user()->id,
        //     'password' => 'sometimes|nullable|min:6|confirmed',
        //     // Add validation rules for other fields as necessary
        // ]);
    
        $teacher = Teacher::find(Auth::user()->id);
        $teacher->name = $request->name;
        $teacher->email = $request->email;
        
        // Update additional fields
        $teacher->bio = $request->bio;
        $teacher->insta_url = $request->insta_url;
        $teacher->fb_url = $request->fb_url;
        $teacher->yt_url = $request->yt_url;
        $teacher->tk_url = $request->tk_url;
        $teacher->whatsapp = $request->whatsapp;
    
        if ($request->filled('password')) {
            $teacher->password = Hash::make($request->password);
        }
    
        $teacher->save();
    
        return back()->with('success', 'Teacher updated successfully.');
    }
}