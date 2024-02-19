<?php

namespace App\Http\Controllers\Auth;

use App\Models\Student\User;

use App\Models\Student\StudentData;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'student/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'study_stage_id' => ['required'],
            // 'study_stage_level_id' => ['required'],

            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            // 'gender' => ['required'],
            // 'specialization' => ['required'],

            'phone' => ['required','unique:users', 'regex:/(01)[0-9]{9}/'],
            'parent_phone' => ['required', 'regex:/(01)[0-9]{9}/', 'different:phone'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $student = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            // 'gender' => $data['gender'],
            'account_status' => 'new',

            'phone' => translateNumbers($data['phone']),
            'parent_phone' => translateNumbers($data['parent_phone']),

            'guardian_code' => \Str::random(6),
            'study_stage_id' => $data['study_stage_id'],
            'study_stage_level_id' => $data['study_stage_level_id'],

            'password' => Hash::make($data['password']),
        ]);

        $StudentData = new StudentData;
        $StudentData->user_id = $student->id;
        $StudentData->save();

        return $student;

    }
}
