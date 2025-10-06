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
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (User Facing)
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'home'])->name('home');

// News
Route::get('/news', [NewsController::class, 'publicIndex'])->name('public.news.index');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('public.news.show');

// Students
Route::get('/students', [StudentController::class, 'publicIndex'])->name('public.students.index');

// Teachers
Route::get('/teachers', [TeacherController::class, 'publicIndex'])->name('public.teachers.index');

// Galleries
Route::get('/galleries', [GalleryController::class, 'publicIndex'])->name('public.galleries.index');
Route::get('/galleries/{id}', [GalleryController::class, 'show'])->name('public.galleries.show');

// Extracurriculars
Route::get('/extracurriculars', [ExtracurricularController::class, 'publicIndex'])->name('public.extracurricular.index');
Route::get('/extracurriculars/{id}', [ExtracurricularController::class, 'show'])->name('public.extracurricular.show');

// School Profile
Route::get('/school-profile', [SchoolProfileController::class, 'show'])->name('school-profile.show');


/*
|--------------------------------------------------------------------------
| Default login redirect (fix: Route [login] not defined)
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    // default redirect ke admin login
    return redirect()->route('admin.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| Authentication Routes (Admin & Operator)
|--------------------------------------------------------------------------
*/

// Admin login
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Operator login
Route::get('/operator/login', [OperatorController::class, 'showLoginForm'])->name('operator.login');
Route::post('/operator/login', [OperatorController::class, 'login'])->name('operator.login.post');
Route::post('/operator/logout', [OperatorController::class, 'logout'])->name('operator.logout');


/*
|--------------------------------------------------------------------------
| Admin Routes (Protected by auth & admin middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.redirect', 'auth', 'admin'])->prefix('administrator')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // School Profile
    Route::get('/school-profile', [SchoolProfileController::class, 'index'])->name('profile.index');
    Route::put('/school-profile/{id}', [SchoolProfileController::class, 'update'])->name('school-profile.update');

    // Students
    Route::get('/students', [StudentController::class, 'index'])->name('students.index');
    Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/destroy/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

    // Teachers
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::put('/teachers/update/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/destroy/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // News
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/update/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/destroy/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Extracurriculars
    Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->name('extracurricular.index');
    Route::post('/extracurricular/store', [ExtracurricularController::class, 'store'])->name('extracurricular.store');
    Route::put('/extracurricular/update/{id}', [ExtracurricularController::class, 'update'])->name('extracurricular.update');
    Route::delete('/extracurricular/destroy/{id}', [ExtracurricularController::class, 'destroy'])->name('extracurricular.destroy');

    // Galleries
    Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::put('/galleries/{id}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/galleries/{id}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
});


/*
|--------------------------------------------------------------------------
| Operator Routes (Protected by auth & operator middleware)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.redirect', 'auth', 'operator'])->prefix('operator')->group(function () {
    Route::get('/', [OperatorController::class, 'dashboard'])->name('operator.dashboard');

    // fitur operator
    Route::get('/students', [StudentController::class, 'index'])->name('operator.students.index');
    Route::get('/teachers', [TeacherController::class, 'index'])->name('operator.teachers.index');
    Route::get('/news', [NewsController::class, 'index'])->name('operator.news.index');
    Route::get('/extracurricular', [ExtracurricularController::class, 'index'])->name('operator.extracurricular.index');
    Route::get('/galleries', [GalleryController::class, 'index'])->name('operator.galleries.index');
});
