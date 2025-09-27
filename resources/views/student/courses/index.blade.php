@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Available Courses</h1>
        <ul class="list-group">
            @foreach($courses as $course)
                <li class="list-group-item">
                    <a href="{{ route('courses.show', $course->id) }}">{{ $course->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

