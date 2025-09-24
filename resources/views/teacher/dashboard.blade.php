@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Teacher Dashboard</h1>
        <p>Welcome, {{ $teacher->name }} 👋</p>

        <div class="mt-4">
            <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary">➕ Add New Course</a>
        </div>

        <h2 class="mt-5">My Courses</h2>

        @if($courses->isEmpty())
            <p>You have not created any courses yet.</p>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Lessons</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->lessons->count() }}</td>
                        <td>
                            @if(isset($course->is_approved) && $course->is_approved)
                                ✅ Approved
                            @else
                                ⏳ Pending Approval
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>

                            <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this course?')">Delete</button>
                            </form>

                            <a href="{{ route('teacher.lessons.create', $course->id) }}" class="btn btn-sm btn-success">+ Add Lesson</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
