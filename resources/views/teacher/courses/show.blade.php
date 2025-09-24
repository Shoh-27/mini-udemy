@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $course->title }}</h2>
        <p>{{ $course->description }}</p>
        <p><strong>Price:</strong> ${{ $course->price }}</p>

        @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" width="200" class="mb-3 rounded shadow">
        @endif

        <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
            <h4>Lessons ({{ $course->lessons->count() }})</h4>
            <a href="{{ route('teacher.lessons.create', $course->id) }}" class="btn btn-primary">➕ Add Lesson</a>
        </div>

        @forelse($course->lessons as $lesson)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->title }}</h5>
                    <p class="card-text">{{ $lesson->content }}</p>

                    @if($lesson->video)
                        <video width="500px" height="500px" controls class="mt-2 rounded">
                            <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    <div class="mt-3">
                        <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                        <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this lesson?')">🗑️ Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No lessons added yet.</p>
        @endforelse
    </div>
@endsection
