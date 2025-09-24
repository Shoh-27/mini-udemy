<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        return view('teacher.lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'nullable',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200', // 50MB
        ]);

        if ($request->hasFile('video')) {
            $data['video'] = $request->file('video')->store('lessons', 'public');
        }

        $data['course_id'] = $course->id;
        Lesson::create($data);

        return redirect()->route('teacher.courses.show', $course->id)
            ->with('success', 'Lesson added!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
