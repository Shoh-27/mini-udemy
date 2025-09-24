@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $course->title }}</h2>
        <p>{{ $course->description }}</p>
        <p><strong>Price:</strong> ${{ $course->price }}</p>

        @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" width="200" class="mb-3">
        @endif

        <h4>Lessons</h4>
        <a href="{{ route('teacher.lessons.create', $course->id) }}" class="btn btn-primary mb-3">+ Add Lesson</a>

        @foreach($course->lessons as $lesson)
            <div class="card mb-3">
                <div class="card-body">
                    <h5>{{ $lesson->title }}</h5>
                    <p>{{ $lesson->content }}</p>

                    @if($lesson->video)
                        <video width="500" controls>
                            <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif

                    <div class="mt-2">
                        <a href="{{ route('teacher.lessons.edit', [$course->id, $lesson->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('teacher.lessons.destroy', [$course->id, $lesson->id]) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this lesson?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

