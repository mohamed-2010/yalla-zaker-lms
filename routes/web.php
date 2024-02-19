<?php

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Student\Auth\SigninController;
use App\Http\Controllers\Student\Auth\SignupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('subject/{subject_id}/teacher/{teacher_id}', [HomeController::class, 'get_teacher_subject_lessons'])->name('subject.details');
Route::get('subject/{teacher_id}', [HomeController::class, 'get_teachers_in_subject'])->name('subject.teachers');
Route::get('subjects/{grade_id}', [HomeController::class, 'get_subjects_with_grade'])->name('subjects.get_subjects_with_grade');
Route::get('teacher/{id}', [HomeController::class, 'teacher_details'])->name('teacher.details');
Route::get('sigin', [HomeController::class, 'sigin'])->name('sigin');
Route::post('signin', [SigninController::class, 'signin'])->name('signin.store');
Route::get('signup', [HomeController::class, 'signup'])->name('signup');
Route::post('signup', [SignupController::class, 'signup'])->name('signup.store');