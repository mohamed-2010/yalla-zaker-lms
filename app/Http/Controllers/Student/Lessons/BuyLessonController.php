<?php

namespace App\Http\Controllers\Student\Lessons;

use App\Http\Controllers\Controller;
use App\Models\CouponeCode;
use Illuminate\Http\Request;

class BuyLessonController extends Controller
{
    public function buyWithOnlinePay(Request $request, $lesson_id)
    {
        
    }

    public function buyWithCoupon(Request $request)
    {
        $coupon_code = CouponeCode::where('code', $request->coupone)->first();
        return response()->json([
            'coupone_data' => $coupon_code
        ], 200);
    }

    public function buyWithWallet(Request $request, $lesson_id)
    {
        
    }
}