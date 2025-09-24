<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = Auth::user();
        $courses = $teacher->courses()->with('lessons')->get();

        return view('teacher.dashboard', compact('teacher', 'courses'));
    }
}
