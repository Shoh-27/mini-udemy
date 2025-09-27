@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <h1 class="text-3xl font-bold text-gray-800 mb-4">🎓 Teacher Dashboard</h1>
        <p class="text-gray-600 mb-6">Welcome, <span class="font-semibold">{{ $teacher->name }}</span> 👋</p>

        <div class="mb-6">
            <a href="{{ route('teacher.courses.create') }}"
               class="bg-blue-500 text-white px-5 py-2 rounded shadow hover:bg-blue-600 transition">
                ➕ Add New Course
            </a>
        </div>

        <h2 class="text-2xl font-semibold mb-4">My Courses</h2>

        @forelse($courses as $course)
            <div class="bg-white shadow rounded-lg mb-4 p-6 transition hover:shadow-lg">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $course->title }}</h3>
                        <p class="mt-1 text-gray-600"><strong>Lessons:</strong> {{ $course->lessons->count() }}</p>
                        <p class="mt-1">
                            <strong>Status:</strong>
                            @if($course->status === 'approved')
                                <span class="text-green-600 font-semibold">✅ Approved</span>
                            @elseif($course->status === 'pending')
                                <span class="text-yellow-600 font-semibold">⏳ Pending Approval</span>
                            @else
                                <span class="text-red-600 font-semibold">❌ Rejected</span>
                            @endif
                        </p>
                        <p class="mt-1"><strong>Enrolled Students:</strong> {{ $course->enrollments->count() }}</p>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('teacher.courses.show', $course->id) }}"
                           class="bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600 transition text-sm">👁 View</a>
                        <a href="{{ route('teacher.courses.edit', $course->id) }}"
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500 transition text-sm">✏️ Edit</a>
                        <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 transition text-sm"
                                    onclick="return confirm('Delete this course?')">🗑 Delete</button>
                        </form>
                        <a href="{{ route('teacher.lessons.create', $course->id) }}"
                           class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition text-sm">➕ Add Lesson</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">You have not created any courses yet.</p>
        @endforelse

    </div>
@endsection
