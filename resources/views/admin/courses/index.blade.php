@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Courses</h2>
        @foreach($courses as $course)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $course->title }}
                        <span class="badge bg-{{ $course->status == 'approved' ? 'success' : ($course->status == 'rejected' ? 'danger' : 'warning') }}">
                        {{ ucfirst($course->status) }}
                    </span>
                    </h5>
                    <p>{{ $course->description }}</p>
                    <a href="{{ route('teacher.courses.show', $course->id) }}" class="btn btn-info btn-sm">View</a>
                    <p><strong>Teacher:</strong> {{ $course->user->name }}</p>

                    @if($course->status == 'pending')
                        <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button class="btn btn-success btn-sm">Approve</button>
                        </form>
                        <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <button class="btn btn-danger btn-sm">Reject</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

