<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\Student\StudentCourseController;
use App\Http\Controllers\TeacherRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/teacher-request', [TeacherRequestController::class, 'store'])
        ->name('teacher.request.store');
});

// Faqat admin ko‘radi
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/teacher-requests', [TeacherRequestController::class, 'index'])
        ->name('admin.teacher.requests');
    Route::post('/admin/teacher-requests/{id}/approve', [TeacherRequestController::class, 'approve'])
        ->name('admin.teacher.requests.approve');
    Route::post('/admin/teacher-requests/{id}/reject', [TeacherRequestController::class, 'reject'])
        ->name('admin.teacher.requests.reject');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/courses', [AdminCourseController::class, 'index'])->name('admin.courses.index');
    Route::get('courses/{course}', [AdminCourseController::class, 'show'])->name('admin.courses.show');
});


Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::patch('/courses/{course}/approve', [AdminCourseController::class, 'approve'])->name('courses.approve');
    Route::patch('/courses/{course}/reject', [AdminCourseController::class, 'reject'])->name('courses.reject');
});



Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});


Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\TeacherDashboardController::class, 'index'])->name('dashboard');
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/', [\App\Http\Controllers\StudentDashboardController::class, 'index'])->name('dashboard');
    Route::get('/courses', [StudentCourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [\App\Http\Controllers\Student\StudentCourseController::class, 'show'])->name('courses.show');
    Route::post('/courses/{course}/enroll', [StudentCourseController::class, 'enroll'])
        ->name('courses.enroll');
    Route::get('/courses/{course}/lessons/{lesson}', [StudentCourseController::class, 'lesson'])
        ->name('courses.lessons.show');

});

Route::middleware(['auth', 'role:student|admin'])->group(function () {
    Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');
});



require __DIR__.'/auth.php';
