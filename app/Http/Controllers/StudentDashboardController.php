<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = auth()->user();
        $enrolledCourses = $student->enrolledCourses()->wherePivot('status', 'active')->get();

        return view('student.dashboard', compact('enrolledCourses'));
    }

}
