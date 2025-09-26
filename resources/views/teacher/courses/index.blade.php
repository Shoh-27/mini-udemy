@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>My Courses</h2>
        <a href="{{ route('teacher.courses.create') }}" class="btn btn-primary mb-3">+ Create Course</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Price</th>
                <th>Lessons</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" width="100">
                        @endif
                    </td>
                    <td>{{ $course->title }}</td>
                    <td>${{ $course->price }}</td>
                    <td>{{ $course->lessons->count() }}</td>
                    <td>
                        <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teacher.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this course?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <td>
                    <span class="badge bg-{{ $course->status == 'approved' ? 'success' : ($course->status == 'rejected' ? 'danger' : 'warning') }}">
                                {{ ucfirst($course->status) }}
                    </span>
                </td>
            @empty
                <tr><td colspan="5">No courses yet.</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
