<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Student\Lessons\BuyLessonController;
use App\Http\Controllers\Student\Dashboard\DashboardController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('new', function() {
    return view('web.new');
})->name('new');

Route::get('ban', function() {
    return view('web.ban');
})->name('ban');

Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    Artisan::call('storage:link');

    return redirect()->back()->with('success', 'تم حذف الكاش بنجاح');
})->name('clear_cache');
Route::get('storage-link', function() {
    // File::deleteDirectory(public_path('storage'));
    Artisan::call('storage:link');

    return redirect()->back()->with('success', 'The [public/storage] directory has been linked.');
})->name('storage-link');
// Auth::routes();

Route::name('student.auth.')->group( function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    // Registration Routes...
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    // Password Reset Routes...
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});


Route::namespace('Dashboard')->name('student.dashboard.')->middleware(['auth'])->prefix('student/dashboard')->group( function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
    Route::post('account/update', [DashboardController::class, 'update_account'])->name('account.update');
    Route::post('apply-coupone', [BuyLessonController::class, 'buyWithCoupon'])->name('lesson.buy_with_coupone');
});