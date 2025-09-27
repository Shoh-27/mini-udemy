<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;

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

//    public function lesson(Course $course, Lesson $lesson)
//    {
//        if ($course->status !== 'approved') {
//            abort(403, 'This course is not available.');
//        }
//
//        // dars shu kursga tegishli bo‘lmasa 404 chiqsin
//        if ($lesson->course_id !== $course->id) {
//            abort(404, 'Lesson not found in this course.');
//        }
//
//        return view('student.courses.lesson', compact('course', 'lesson'));
//    }

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
