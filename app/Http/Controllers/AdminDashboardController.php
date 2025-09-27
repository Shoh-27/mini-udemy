<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistikalar
        $stats = [
            'total_users' => User::count(),
            'total_courses' => Course::count(),
            'total_enrollments' => Enrollment::count(),
        ];

        // Kurslar bilan birga nechta student enroll bo‘lganini olish
        $courses = Course::with('teacher')
            ->withCount('enrollments')
            ->orderBy('created_at', 'desc')
            ->take(10) // faqat oxirgi 10 ta kurs
            ->get();

        // Foydalanuvchilar (teacher va studentlar)
        $users = User::withCount([
            'courses as courses_count' => fn($q) => $q, // teacher uchun kurslar soni
            'enrollments as enrollments_count' => fn($q) => $q // student uchun enroll soni
        ])
            ->latest()
            ->take(10) // faqat oxirgi 10 ta user
            ->get();

        // Oxirgi enrollments
        $enrollments = Enrollment::with(['user', 'course'])
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'courses', 'users', 'enrollments'));
    }
}
