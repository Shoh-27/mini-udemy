<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

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
}
