@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Student Dashboard</h1>
        <a href="{{ route('student.courses.index') }}" class="btn btn-primary">View Courses</a>
    </div>
@endsection

