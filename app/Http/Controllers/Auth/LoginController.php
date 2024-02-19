<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\StudentSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = 'student/home';

    protected function authenticated(Request $request, $user)
    {
        $StudentSession = new StudentSession;
        $StudentSession->user_id = $user->id;
        $StudentSession->ip = $request->ip();

        $StudentSession->platform_name = Browser::platformName();
        $StudentSession->platform_family = Browser::platformFamily();
        $StudentSession->platform_version = Browser::platformVersion();
        
        $StudentSession->browser_name = Browser::browserName();
        $StudentSession->browser_family = Browser::browserFamily();
        $StudentSession->browser_version = Browser::browserVersion();

        $StudentSession->device_family = Browser::deviceFamily();
        $StudentSession->device_model = Browser::deviceModel();
        $StudentSession->mobile_grade = Browser::mobileGrade();
        $StudentSession->save();
    }

   

    public function username()
    {
        return 'phone';
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('adminLogout');
        $this->middleware('guest:teacher')->except('teacherLogout');
        // return dd("After Teacher");
    }


    public function showAdminLoginForm()
    {
        return view('auth.admin_login');
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);


        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('dashboard.home');
        }

        return back()->withInput($request->only('email', 'remember'))
        ->withErrors(['email' => 'The provided credentials do not match our records.']);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('dashboard.signin');
    }


    public function showTeacherLoginForm()
    {
        return view('auth.teacher_login');
    }

    public function teacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);


        if (Auth::guard('teacher')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->route('dashboard.teacher.home');
        }

        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function teacherLogout(Request $request)
    {
        Auth::guard('teacher')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }




}
