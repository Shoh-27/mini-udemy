@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Lesson in {{ $course->title }}</h2>
        <form action="{{ route('teacher.lessons.update', [$course->id, $lesson->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="text" name="title" value="{{ $lesson->title }}" class="form-control mb-2" required>
            <textarea name="content" class="form-control mb-2">{{ $lesson->content }}</textarea>

            @if($lesson->video)
                <p>Current Video:</p>
                <video width="400" controls>
                    <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            @endif

            <input type="file" name="video" accept="video/*" class="form-control mb-2">

            <button class="btn btn-warning">Update Lesson</button>
        </form>
    </div>
@endsection

