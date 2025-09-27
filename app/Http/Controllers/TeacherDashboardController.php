<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();

        // Teacher kurslari, ular bilan birga lessons va enrollments (student bilan)
        $courses = $teacher->courses()
            ->with(['lessons', 'enrollments.student'])
            ->get();

        return view('teacher.dashboard', compact('teacher', 'courses'));
    }
}
