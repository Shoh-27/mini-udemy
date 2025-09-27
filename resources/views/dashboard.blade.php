@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }} 👋</p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(Auth::user()->hasRole('admin'))
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Go to Admin Dashboard</a>
        @elseif(Auth::user()->hasRole('teacher'))
            <a href="{{ route('teacher.dashboard') }}" class="btn btn-primary">Go to Teacher Dashboard</a>
        @else
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">Go to Student Dashboard</a>

            <!-- Teacher bo‘lish uchun so‘rov -->
        @endif
    </div>
@endsection

