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
        // agar kurs approved bo‘lmasa student ko‘ra olmaydi
        if ($course->status !== 'approved') {
            abort(403, 'This course is not available.');
        }

        $lessons = $course->lessons;

        return view('student.courses.show', compact('course', 'lessons'));
    }

    public function lesson(Course $course, Lesson $lesson)
    {
        if ($course->status !== 'approved') {
            abort(403, 'This course is not available.');
        }

        // dars shu kursga tegishli bo‘lmasa 404 chiqsin
        if ($lesson->course_id !== $course->id) {
            abort(404, 'Lesson not found in this course.');
        }

        return view('student.courses.lesson', compact('course', 'lesson'));
    }
}
