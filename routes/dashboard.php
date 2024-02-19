<?php

use App\Enums\RolesEnum;
use App\Http\Controllers\Dashboard\AreaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CouponeCodeController;
use App\Http\Controllers\Dashboard\Exams\ExamsController;
use App\Http\Controllers\Dashboard\Exams\QuestionsController;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RecordedLessonController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\TeachersController;
use App\Http\Controllers\Dashboard\GovernmentController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\StudentsController;
use App\Http\Controllers\Profile\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard/login', [LoginController::class, 'showAdminLoginForm'])->name('dashboard.signin');
Route::get('dashboard/teacher/login', [LoginController::class, 'showTeacherLoginForm']);
Route::post('dashboard/login', [LoginController::class, 'adminLogin'])->name('dashboard.login');
Route::post('dashboard/teacher/login', [LoginController::class, 'teacherLogin'])->name('dashboard.teacher.login');

// Admin Routes
Route::namespace('Dashboard')->name('dashboard.')->middleware(['auth:admin'])->prefix('dashboard')->group( function () {
    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name('index');
        Route::get('create', [RoleController::class, 'create'])->name('create');
        Route::post('create', [RoleController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [RoleController::class, 'update'])->name('update');
        Route::get('delete/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });
    Route::get('dashboard/logout', [LoginController::class, 'adminLogout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::prefix('grades')->name('grades.')->group(function () {
        Route::get('/', [GradeController::class, 'index'])->name('index');
        Route::get('create', [GradeController::class, 'create'])->name('create');
        Route::post('create', [GradeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [GradeController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [GradeController::class, 'update'])->name('update');
        Route::get('delete/{id}', [GradeController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('create', [CategoryController::class, 'create'])->name('create');
        Route::post('create', [CategoryController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [CategoryController::class, 'update'])->name('update');
        Route::get('delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    
    Route::prefix('subjects')->name('subjects.')->group(function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('create', [SubjectController::class, 'create'])->name('create');
        Route::post('create', [SubjectController::class, 'store'])->name('store');
        Route::get('edit/{id}', [SubjectController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [SubjectController::class, 'update'])->name('update');
        Route::get('delete/{id}', [SubjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('teachers')->name('teachers.')->group(function () {
        Route::get('/', [TeachersController::class, 'index'])->name('index');
        Route::get('create', [TeachersController::class, 'create'])->name('create');
        Route::post('create', [TeachersController::class, 'store'])->name('store');
        Route::get('edit/{id}', [TeachersController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [TeachersController::class, 'update'])->name('update');
        Route::get('delete/{id}', [TeachersController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('/', [ExamsController::class, 'index'])->name('index');
        Route::get('create', [ExamsController::class, 'create'])->name('create');
        Route::post('create', [ExamsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ExamsController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [ExamsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ExamsController::class, 'destroy'])->name('destroy');

        Route::get('/{id}/answers', [ExamsController::class, 'answers'])->name('answers');
    });

    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('exam-bank/{exam_id}/add-question', [QuestionsController::class, 'create'])->name('create');
        Route::get('exam-bank/{exam_id}/questions', [QuestionsController::class, 'examQuestions'])->name('examQuestions'); 
        Route::post('create', [QuestionsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [QuestionsController::class, 'update'])->name('update');
        Route::get('delete/{id}', [QuestionsController::class, 'destroy'])->name('destroy');
    });
    
    // Route::resource('questions', QuestionsController::class)->except(['create', 'index']);   
    // Route::get('exam-bank/{exam_id}/add-question', [QuestionsController::class, 'create'])->name('questions.create');
    // Route::get('exam-bank/{exam_id}/questions', [QuestionsController::class, 'examQuestions'])->name('questions.examQuestions'); 

    Route::prefix('lessons')->name('recorded-lessons.')->group(function () {
        Route::get('/', [RecordedLessonController::class, 'index'])->name('index');
        Route::get('create', [RecordedLessonController::class, 'create'])->name('create');
        Route::post('create', [RecordedLessonController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RecordedLessonController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [RecordedLessonController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [RecordedLessonController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('address')->group(function () {
            Route::prefix('areas')->name('areas.')->group(function () {
            Route::get('/', [AreaController::class, 'index'])->name('index');
            Route::get('create', [AreaController::class, 'create'])->name('create');
            Route::post('create', [AreaController::class, 'store'])->name('store');
            Route::get('edit/{id}', [AreaController::class, 'edit'])->name('edit');
            Route::put('edit/{id}', [AreaController::class, 'update'])->name('update');
            Route::get('delete/{id}', [AreaController::class, 'destroy'])->name('destroy');
        });
        
        Route::prefix('governments')->name('governments.')->group(function () {
            Route::get('/', [GovernmentController::class, 'index'])->name('index');
            Route::get('create', [GovernmentController::class, 'create'])->name('create');
            Route::post('create', [GovernmentController::class, 'store'])->name('store');
            Route::get('edit/{id}', [GovernmentController::class, 'edit'])->name('edit');
            Route::put('edit/{id}', [GovernmentController::class, 'update'])->name('update');
            Route::get('delete/{id}', [GovernmentController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('coupone-codes')->name('coupone_codes.')->group(function () {
        Route::get('/', [CouponeCodeController::class, 'index'])->name('index');
        Route::get('create', [CouponeCodeController::class, 'create'])->name('create');
        Route::post('create', [CouponeCodeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CouponeCodeController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [CouponeCodeController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CouponeCodeController::class, 'destroy'])->name('destroy');
    });

    
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('create', [BookController::class, 'create'])->name('create');
        Route::post('create', [BookController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [BookController::class, 'update'])->name('update');
        Route::get('delete/{id}', [BookController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('edit', [ProfileController::class, 'update_admin'])->name('update');
    });

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/', [StudentsController::class, 'index'])->name('index');
        Route::get('create', [StudentsController::class, 'create'])->name('create');
        Route::get('show/{id}', [StudentsController::class, 'show'])->name('show');
        Route::post('create', [StudentsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [StudentsController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [StudentsController::class, 'update'])->name('update');
        Route::get('delete/{id}', [StudentsController::class, 'destroy'])->name('destroy');
        Route::get('find', [StudentsController::class, 'find'])->name('find');
        Route::get('new', [StudentsController::class, 'new'])->name('new');
        Route::get('ban', [StudentsController::class, 'ban'])->name('ban');
        Route::get('{id}/sessions', [StudentsController::class, 'student_sessions'])->name('sessions');
    });

    Route::prefix('student')->name('student.')->group(function() {
        Route::get('{id}/{status}/account-status-update', [StudentsController::class, 'account_status_update'])->name('account-status-update');
        Route::get('{id}/add-wallet', [StudentsController::class, 'addWalletView'])->name('addWalletView');
        Route::post('add-wallet', [StudentsController::class, 'addWallet'])->name('addWallet');
        Route::get('{id}/edit-wallet', [StudentsController::class, 'editWalletView'])->name('editWalletView');
        Route::post('edit-wallet', [StudentsController::class, 'editWallet'])->name('editWallet');
    });
    
});

Route::namespace('Dashboard')->name('dashboard.teacher.')->middleware(['auth:teacher'])->prefix('dashboard/teacher')->group( function () {
    Route::get('dashboard/teacher/logout', [LoginController::class, 'teacherLogout'])->name('logout');
    Route::get('home', [HomeController::class, 'index'])->name('home');
    
    Route::prefix('exams')->name('exams.')->group(function () {
        Route::get('/', [ExamsController::class, 'index'])->name('index');
        Route::get('create', [ExamsController::class, 'create'])->name('create');
        Route::post('create', [ExamsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [ExamsController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [ExamsController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [ExamsController::class, 'destroy'])->name('destroy');

        Route::get('/{id}/answers', [ExamsController::class, 'answers'])->name('answers');
    });

    Route::prefix('questions')->name('questions.')->group(function () {
        Route::get('exam-bank/{exam_id}/add-question', [QuestionsController::class, 'create'])->name('create');
        Route::get('exam-bank/{exam_id}/questions', [QuestionsController::class, 'examQuestions'])->name('examQuestions'); 
        Route::post('create', [QuestionsController::class, 'store'])->name('store');
        Route::get('edit/{id}', [QuestionsController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [QuestionsController::class, 'update'])->name('update');
        Route::get('delete/{id}', [QuestionsController::class, 'destroy'])->name('destroy');
    });
    
    // Route::resource('questions', QuestionsController::class)->except(['create', 'index']);   
    // Route::get('exam-bank/{exam_id}/add-question', [QuestionsController::class, 'create'])->name('questions.create');
    // Route::get('exam-bank/{exam_id}/questions', [QuestionsController::class, 'examQuestions'])->name('questions.examQuestions'); 

    Route::prefix('lessons')->name('recorded-lessons.')->group(function () {
        Route::get('/', [RecordedLessonController::class, 'index'])->name('index');
        Route::get('create', [RecordedLessonController::class, 'create'])->name('create');
        Route::post('create', [RecordedLessonController::class, 'store'])->name('store');
        Route::get('edit/{id}', [RecordedLessonController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [RecordedLessonController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [RecordedLessonController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('coupone-codes')->name('coupone_codes.')->group(function () {
        Route::get('/', [CouponeCodeController::class, 'index'])->name('index');
        Route::get('create', [CouponeCodeController::class, 'create'])->name('create');
        Route::post('create', [CouponeCodeController::class, 'store'])->name('store');
        Route::get('edit/{id}', [CouponeCodeController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [CouponeCodeController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [CouponeCodeController::class, 'destroy'])->name('destroy');
    });

    
    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('create', [BookController::class, 'create'])->name('create');
        Route::post('create', [BookController::class, 'store'])->name('store');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('edit');
        Route::put('edit/{id}', [BookController::class, 'update'])->name('update');
        Route::get('delete/{id}', [BookController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('edit', [ProfileController::class, 'update_teacher'])->name('update');
    });
});