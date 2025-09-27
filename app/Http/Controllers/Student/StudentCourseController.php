<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;

class StudentCourseController extends Controller
{
    public function dashboard()
    {
        return view('student.dashboard');
    }

    public function index()
    {
        $courses = Course::where('status == approved', true)->get();
        return view('student.courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if (!$course->approved) {
            abort(403, 'This course is not available.');
        }
        $lessons = $course->lessons;
        return view('student.courses.show', compact('course', 'lessons'));
    }

    public function lesson(Lesson $lesson)
    {
        if (!$lesson->course->approved) {
            abort(403, 'This lesson is not available.');
        }
        return view('student.lessons.show', compact('lesson'));
    }
}
