<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ExtracurricularController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SchoolProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// ============================
// PUBLIC ROUTES
// ============================
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/news', [NewsController::class, 'publicIndex'])->name('public.news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('public.news.show');

Route::get('/students', [StudentController::class, 'publicIndex'])->name('public.students.index');
Route::get('/teachers', [TeacherController::class, 'publicIndex'])->name('public.teachers.index');
Route::get('/galleries', [GalleryController::class, 'publicIndex'])->name('public.galleries.index');
Route::get('/galleries/{id}', [GalleryController::class, 'show'])->name('public.galleries.show');
Route::get('/extracurriculars', [ExtracurricularController::class, 'publicIndex'])->name('public.extracurricular.index');
Route::get('/extracurriculars/{id}', [ExtracurricularController::class, 'show'])->name('public.extracurricular.show');
Route::get('/school-profile', [SchoolProfileController::class, 'show'])->name('school-profile.show');

// ============================
// LOGIN ROUTES
// ============================
Route::get('/login', fn() => redirect()->route('admin.login'))->name('login');

// Admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Operator login
Route::get('/operator/login', [OperatorController::class, 'showLoginForm'])->name('operator.login');
Route::post('/operator/login', [OperatorController::class, 'login'])->name('operator.login.post');
Route::post('/operator/logout', [OperatorController::class, 'logout'])->name('operator.logout');


// ============================
// ADMIN ROUTES (MANUAL)
// ============================
Route::middleware(['auth.redirect', 'auth', 'admin'])->group(function () {
    Route::get('/administrator', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Users (Manajemen Akun)
    Route::get('/administrator/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/administrator/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/administrator/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/administrator/users/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // School Profile
    Route::get('/administrator/school-profile', [SchoolProfileController::class, 'index'])->name('profile.index');
    Route::put('/administrator/school-profile/{id}', [SchoolProfileController::class, 'update'])->name('school-profile.update');

    // Students
    Route::get('/administrator/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/administrator/students/store', [StudentController::class, 'store'])->name('students.store');
    Route::put('/administrator/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/administrator/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Teachers
    Route::get('/administrator/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/administrator/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::put('/administrator/teachers/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/administrator/teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // News
    Route::get('/administrator/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/administrator/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::put('/administrator/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/administrator/news/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Extracurriculars
    Route::get('/administrator/extracurricular', [ExtracurricularController::class, 'index'])->name('extracurricular.index');
    Route::post('/administrator/extracurricular/store', [ExtracurricularController::class, 'store'])->name('extracurricular.store');
    Route::put('/administrator/extracurricular/update/{id}', [ExtracurricularController::class, 'update'])->name('extracurricular.update');
    Route::delete('/administrator/extracurricular/destroy/{id}', [ExtracurricularController::class, 'destroy'])->name('extracurricular.destroy');

    // Galleries
    Route::get('/administrator/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::post('/administrator/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::put('/administrator/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/administrator/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});


// ============================
// OPERATOR ROUTES (MANUAL)
// ============================
Route::middleware(['auth.redirect', 'auth', 'operator'])->group(function () {
    Route::get('/operator', [OperatorController::class, 'dashboard'])->name('operator.dashboard');

    // Students
    Route::get('/operator/students', [StudentController::class, 'index'])->name('operator.students.index');
    Route::post('/operator/students/store', [StudentController::class, 'store'])->name('operator.students.store');
    Route::put('/operator/students/update/{id}', [StudentController::class, 'update'])->name('operator.students.update');
    Route::delete('/operator/students/destroy/{id}', [StudentController::class, 'destroy'])->name('operator.students.destroy');

    // Teachers
    Route::get('/operator/teachers', [TeacherController::class, 'index'])->name('operator.teachers.index');
    Route::post('/operator/teachers/store', [TeacherController::class, 'store'])->name('operator.teachers.store');
    Route::put('/operator/teachers/update/{id}', [TeacherController::class, 'update'])->name('operator.teachers.update');
    Route::delete('/operator/teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('operator.teachers.destroy');

    // News
    Route::get('/operator/news', [NewsController::class, 'index'])->name('operator.news.index');
    Route::post('/operator/news/store', [NewsController::class, 'store'])->name('operator.news.store');
    Route::put('/operator/news/update/{id}', [NewsController::class, 'update'])->name('operator.news.update');
    Route::delete('/operator/news/destroy/{id}', [NewsController::class, 'destroy'])->name('operator.news.destroy');

    // Extracurriculars
    Route::get('/operator/extracurricular', [ExtracurricularController::class, 'index'])->name('operator.extracurricular.index');
    Route::post('/operator/extracurricular/store', [ExtracurricularController::class, 'store'])->name('operator.extracurricular.store');
    Route::put('/operator/extracurricular/update/{id}', [ExtracurricularController::class, 'update'])->name('operator.extracurricular.update');
    Route::delete('/operator/extracurricular/destroy/{id}', [ExtracurricularController::class, 'destroy'])->name('operator.extracurricular.destroy');

    // Galleries
    Route::get('/operator/galleries', [GalleryController::class, 'index'])->name('operator.galleries.index');
    Route::post('/operator/galleries', [GalleryController::class, 'store'])->name('operator.galleries.store');
    Route::put('/operator/galleries/{id}', [GalleryController::class, 'update'])->name('operator.galleries.update');
    Route::delete('/operator/galleries/{id}', [GalleryController::class, 'destroy'])->name('operator.galleries.destroy');
});
