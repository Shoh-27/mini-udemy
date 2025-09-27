<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
{
    /**
     * Show all approved courses for students.
     */
    public function index()
    {
        // faqat admin tasdiqlagan kurslarni olish
        $courses = Course::where('status', 'approved')->get();

        return view('student.courses.index', compact('courses'));
    }

    /**
     * Show a single approved course with lessons.
     */
    public function show(Course $course)
    {
        // faqat approved kurslarga kirish mumkin
        if ($course->status !== 'approved') {
            abort(403, 'This course is not available for students.');
        }

        return view('student.courses.show', compact('course'));
    }

    public function lesson(Course $course, Lesson $lesson)
    {
        // Student kursga enroll bo‘lganmi?
        if (!$course->students()->where('user_id', Auth::id())->exists()) {
            abort(403, 'Siz bu kursga yozilmagansiz.');
        }

        // Lesson shu kursga tegishli bo‘lishini tekshiramiz
        if ($lesson->course_id !== $course->id) {
            abort(404, 'Bunday dars topilmadi.');
        }

        return view('student.courses.lesson', compact('course', 'lesson'));
    }

    public function enroll(Course $course)
    {
        $user = auth()->user();

        // Agar oldin yozilgan bo‘lsa
        if ($user->enrollments()->where('course_id', $course->id)->exists()) {
            return redirect()->route('courses.show', $course->id)
                ->with('info', 'Siz allaqachon bu kursga yozilgansiz.');
        }

        // Yangi enrollment
        $user->enrollments()->create([
            'course_id' => $course->id,
            'status' => 'active',
        ]);

        return redirect()->route('courses.show', $course->id)
            ->with('success', 'Kursga muvaffaqiyatli yozildingiz!');
    }

}
