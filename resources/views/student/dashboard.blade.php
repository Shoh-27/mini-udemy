@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>🎓 Student Dashboard</h2>
        <p>Welcome, {{ auth()->user()->name }}!</p>

        <h4 class="mt-4">📚 My Enrolled Courses</h4>

        @forelse($enrolledCourses as $course)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text">{{ Str::limit($course->description, 120) }}</p>
                    <p><strong>Status:</strong> {{ ucfirst($course->pivot->status) }}</p>
                    <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary btn-sm">
                        👉 View Course
                    </a>
                </div>
            </div>
        @empty
            <p class="text-muted">Siz hali birorta kursga yozilmagansiz.</p>
        @endforelse
    </div>

    <form action="{{ route('teacher.request.store') }}" method="POST">
        @csrf
        <textarea name="reason" placeholder="Nima uchun teacher bo‘lishni xohlaysiz?" required></textarea>
        <button type="submit">Teacher bo‘lish uchun sorov yuborish</button>
    </form>

@endsection

