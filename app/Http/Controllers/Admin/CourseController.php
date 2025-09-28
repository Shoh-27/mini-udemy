<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('user')->latest()->get();
        return view('admin.courses.index', compact('courses'));
    }
    public function approve(Course $course)
    {
        $course->update(['status' => 'approved']);
        return back()->with('success', 'Course approved!');
    }

    public function reject(Course $course)
    {
        $course->update(['status' => 'rejected']);
        return back()->with('error', 'Course rejected!');
    }

    public function show(Course $course)
    {
        $user = auth()->user();

        // Agar admin bo‘lsa → barcha kurslarni ko‘rishi mumkin
        if ($user->hasRole('admin')) {
            return view('teacher.courses.show', compact('course'));
        }

        // Teacher bo‘lsa → faqat o‘z kursini ko‘rishi mumkin
        if ($user->hasRole('teacher')) {
            $this->authorizeCourse($course);
            return view('teacher.courses.show', compact('course'));
        }

        // Student yoki boshqa rolga → ruxsat yo‘q
        abort(403, 'Sizga bu sahifani ko‘rishga ruxsat berilmagan.');
    }

}
