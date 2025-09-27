@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Teacher Dashboard</h1>
        <p>Welcome, {{ $teacher->name }} 👋</p>

        <div class="mt-4">
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">➕ Add New Course</a>
        </div>

        <h2 class="mt-5">My Courses</h2>

        @forelse($courses as $course)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">{{ $course->title }}</h4>
                    <p><strong>Lessons:</strong> {{ $course->lessons->count() }}</p>
                    <p>
                        <strong>Status:</strong>
                        @if($course->status === 'approved')
                            ✅ Approved
                        @elseif($course->status === 'pending')
                            ⏳ Pending Approval
                        @else
                            ❌ Rejected
                        @endif
                    </p>
                    <p><strong>Enrolled Students:</strong> {{ $course->enrollments->count() }}</p>

                    <div class="mt-3">
                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-sm btn-info">👁 View</a>
                        <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>

                        <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">🗑 Delete</button>
                        </form>

                        <a href="{{ route('teacher.lessons.create', $course->id) }}" class="btn btn-sm btn-success">➕ Add Lesson</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">You have not created any courses yet.</p>
        @endforelse
    </div>
@endsection
