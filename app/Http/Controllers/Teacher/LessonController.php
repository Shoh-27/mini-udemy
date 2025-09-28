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
//        $this->authorizeCourse($course);
        return view('teacher.lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
//        $this->authorizeCourse($course);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string', // 🔄 content o‘rniga description
            'video' => 'nullable|mimes:mp4,mov,avi,wmv,webm,ogg|max:51200', // 50MB
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
//        $this->authorizeCourse($course);
        return view('teacher.lessons.edit', compact('course', 'lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        // Validate request
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'video' => 'nullable|mimes:mp4,mov,avi|max:102400', // max 100MB
        ]);

        // Agar video yuklangan bo‘lsa, eski videoni o‘chirish va yangisini saqlash
        if ($request->hasFile('video')) {
            if ($lesson->video) {
                Storage::delete($lesson->video);
            }
            $data['video'] = $request->file('video')->store('lessons');
        }

        // Lessonni yangilash
        $lesson->update($data);

        // Kurs modelini olish
        $course = $lesson->course;

        // Teacher dashboard sahifasiga redirect qilish
        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Lesson updated successfully!');
    }


    public function destroy(Course $course, Lesson $lesson)
    {
        // Lesson o'chiriladi
        $lesson->delete();

        // Teacher kurs sahifasiga redirect
        return redirect()->route('teacher.courses.show', $course)
            ->with('success', 'Lesson deleted successfully!');
    }


}
