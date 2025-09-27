@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $lesson->title }}</h2>

        <p>{{ $lesson->content }}</p>

        @if($lesson->video)
            <video width="600" controls class="rounded shadow">
                <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif

        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-secondary mt-3">⬅️ Kursga qaytish</a>
    </div>
@endsection

