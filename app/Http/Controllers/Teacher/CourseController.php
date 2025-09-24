<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // Faqat Teacher o'z kurslarini ko'radi
        $courses = Auth::user()->courses;
        return view('teacher.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('teacher.courses.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $data['user_id'] = Auth::id();

        $course = Course::create($data);

        return redirect()->route('teacher.courses.show', $course->id)
            ->with('success', 'Course created successfully!');
    }

    public function show(Course $course)
    {
        $this->authorizeCourse($course);
        return view('teacher.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $this->authorizeCourse($course);
        return view('teacher.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $this->authorizeCourse($course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($data);

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course updated successfully!');
    }

    public function destroy(Course $course)
    {
        $this->authorizeCourse($course);
        $course->delete();

        return redirect()->route('teacher.courses.index')
            ->with('success', 'Course deleted successfully!');
    }

    private function authorizeCourse(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
