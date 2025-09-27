@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <h2 class="text-3xl font-bold text-gray-800 mb-4">🎓 Student Dashboard</h2>
        <p class="text-gray-600 mb-6">Welcome, <span class="font-semibold">{{ auth()->user()->name }}</span>!</p>

        <!-- Enrolled Courses -->
        <h4 class="text-xl font-semibold mb-3">📚 My Enrolled Courses</h4>

        @forelse($enrolledCourses as $course)
            <div class="bg-white shadow rounded-lg p-5 mb-4 hover:shadow-lg transition">
                <h5 class="text-lg font-bold text-gray-800">{{ $course->title }}</h5>
                <p class="text-gray-600 mt-1">{{ Str::limit($course->description, 120) }}</p>
                <p class="text-sm mt-2"><strong>Status:</strong> <span class="text-blue-600">{{ ucfirst($course->pivot->status) }}</span></p>
                <a href="{{ route('student.courses.show', $course->id) }}"
                   class="mt-3 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    👉 View Course
                </a>
            </div>
        @empty
            <p class="text-gray-500 italic">Siz hali birorta kursga yozilmagansiz.</p>
        @endforelse

        <!-- Teacher Request Form -->
        <div class="bg-white shadow rounded-lg p-6 mt-8">
            <h4 class="text-xl font-semibold mb-3">📩 Teacher Request</h4>
            <form action="{{ route('teacher.request.store') }}" method="POST" class="space-y-4">
                @csrf
                <textarea name="reason"
                          placeholder="Nima uchun teacher bo‘lishni xohlaysiz?"
                          required
                          class="w-full border border-gray-300 rounded p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                <button type="submit"
                        class="bg-green-500 text-white px-5 py-2 rounded hover:bg-green-600 transition">
                    Teacher bo‘lish uchun sorov yuborish
                </button>
            </form>
        </div>

    </div>
@endsection
