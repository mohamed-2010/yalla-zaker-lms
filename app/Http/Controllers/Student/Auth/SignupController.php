<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\Government;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\User; // Add this import statement
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function index() {
        $governments = Government::with('areas')->get();
        return view('student.auth.signup', compact('governments'));
    }

    public function signup(Request $request)
    {
        try {

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->account_status = "new";
            $user->area_id = $request->area;
            $user->phone = $request->phone;
            $user->parent_phone = $request->parent_phone;
            $user->government_id = $request->government;
            $user->attend_type = $request->attend_type;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'تم انشاء الحساب بنجاح و سيتم مراجعته و قبوله خلال مده قصيره');

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withInput($request->all())->with('error', 'حدث خطأ أثناء تسجيل الدخول. يرجى المحاولة مرة أخرى.');
        }
    }
}
