@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Available Courses</h1>
        <ul class="list-group">
            @foreach($courses as $course)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->title }}</h5>
                        <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
                        <a href="{{ route('student.courses.show', $course->id) }}" class="btn btn-primary">
                            View Course
                        </a>
                    </div>
                </div>
            @endforeach

        </ul>
    </div>
@endsection

