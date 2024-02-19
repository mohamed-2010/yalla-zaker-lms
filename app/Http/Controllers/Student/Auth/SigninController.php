<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Add this import statement

class SigninController extends Controller
{
    public function index() {
        return view('student.auth.signin');
    }

    public function signin(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
    
            // Use the provided credentials to retrieve the user before authentication
            $user = User::where('email', $credentials['email'])->first();
    
            if (!$user) {
                return back()->withInput($request->all())->with('error', 'بيانات الاعتماد غير صحيحة. يرجى المحاولة مرة أخرى.');
            }

            if($user->account_status == "new") {
                return back()->withInput($request->all())->with('error', 'لم يتم قبول الحساب بعد.');
            }
    
            // Check if the user is already authenticated from more than two devices
            if ($user->userSessions()->count() >= 2) {
                return back()->withInput($request->all())->with('error', 'عذرًا، لا يمكنك تسجيل الدخول من أكثر من جهازين في نفس الوقت.');
            }
    
            // Check if the user is banned
            if ($user->isBanned()) {
                return back()->withInput($request->all())->with('error', 'عذرًا، لا يمكنك تسجيل الدخول حاليًا.');
            }
    
            // Attempt to authenticate the user with the provided credentials
            if (Auth::attempt($credentials)) {
                // Record the user session now that they're authenticated
                $user->recordSession();
    
                // Redirect to the dashboard or any other page
                return redirect()->route('student.dashboard.index')->with('success', 'تم تسجيل الدخول بنجاح');
            } else {
                return back()->withInput($request->all())->with('error', 'بيانات الاعتماد غير صحيحة. يرجى المحاولة مرة أخرى.');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput($request->all())->with('error', 'حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.');
        }
    }
    
}
