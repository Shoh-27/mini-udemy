@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $course->title }}</h2>
        <p>{{ $course->description }}</p>
        <p><strong>Price:</strong> ${{ $course->price }}</p>

        {{-- Kurs rasmi --}}
        @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" width="200" class="mb-3 rounded shadow">
        @endif

        {{-- Enroll tugmasi --}}
        <div class="my-3">
            @if(Auth::user()->enrolledCourses->contains($course->id))
                <button class="btn btn-success" disabled>✅ Enrolled</button>
            @else
                <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">📚 Enroll Course</button>
                </form>
            @endif
        </div>

        <h4 class="mt-4">Lessons</h4>
        @forelse($course->lessons as $lesson)
            <div class="card mb-2">
                <div class="card-body">
                    <h5>{{ $lesson->title }}</h5>
                    <p>{{ $lesson->description }}</p>

                    @if($lesson->video)
                        <video width="400" controls>
                            <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">No lessons yet.</p>
        @endforelse
    </div>
@endsection
