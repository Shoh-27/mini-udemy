@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $course->title }}</h1>
        <p>{{ $course->description }}</p>

        <h3>Lessons</h3>
        <ul class="list-group">
            @foreach($lessons as $lesson)
                <li class="list-group-item">
                    <a href="{{ route('student.lessons.show', $lesson->id) }}">{{ $lesson->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

