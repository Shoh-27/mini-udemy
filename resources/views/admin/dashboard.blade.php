@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>
        <ul>
            <li><a href="{{ route('users.index') }}">Users: {{ $stats['total_users'] }}</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
            <li><a href="{{ route('courses.index') }}">Courses: {{ $stats['total_courses'] }}</a></li>
        </ul>
        <div class="row mb-4">
            <div class="col-md-2">Enrollments: {{ $stats['total_enrollments'] }}</div>
        </div>

        <h3>Oxirgi kurslar</h3>
        <ul>
            @foreach($courses as $course)
                <li>{{ $course->title }} ({{ $course->enrollments_count }} ta student) - Teacher: {{ $course->teacher->name }}</li>
            @endforeach
        </ul>

        <h3>Oxirgi foydalanuvchilar</h3>
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }} ({{ $user->role }})
                    - Kurslar: {{ $user->courses_count ?? 0 }}
                    - Enrollments: {{ $user->enrollments_count ?? 0 }}
                </li>
            @endforeach
        </ul>

        <h3>Oxirgi enrollments</h3>
        <ul>
            @foreach($enrollments as $enroll)
                <li>{{ $enroll->user->name }} → {{ $enroll->course->title }} ({{ $enroll->status }})</li>
            @endforeach
        </ul>
    </div>
@endsection

