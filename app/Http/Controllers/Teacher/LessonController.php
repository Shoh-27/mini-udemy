<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LessonController extends Controller
{
    public function create(Course $course)
    {
        $this->authorizeCourse($course);
        return view('teacher.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $this->authorizeCourse($course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200', // max 50MB
        ]);

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('lessons', 'public');
        }

        $data['course_id'] = $course->id;
        Lesson::create($data);

        return redirect()->route('teacher.courses.show', $course->id)
            ->with('success', 'Lesson added successfully!');
    }

    public function edit(Course $course, Lesson $lesson)
    {
        $this->authorizeCourse($course);
        return view('teacher.lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Course $course, Lesson $lesson)
    {
        $this->authorizeCourse($course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200',
        ]);

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('lessons', 'public');
        }

        $lesson->update($data);

        return redirect()->route('teacher.courses.show', $course->id)
            ->with('success', 'Lesson updated successfully!');
    }

    public function destroy(Course $course, Lesson $lesson)
    {
        $this->authorizeCourse($course);
        $lesson->delete();

        return redirect()->route('teacher.courses.show', $course->id)
            ->with('success', 'Lesson deleted successfully!');
    }

    private function authorizeCourse(Course $course)
    {
        if ($course->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}
