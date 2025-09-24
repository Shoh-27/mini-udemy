<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\CourseController;
use App\Http\Controllers\Teacher\LessonController;
use App\Http\Controllers\TeacherDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Users
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Categories
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
});


Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
});


Route::middleware(['auth', 'role:teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('courses', CourseController::class);
    Route::get('courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
});


require __DIR__.'/auth.php';
