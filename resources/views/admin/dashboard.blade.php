@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">Admin Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white shadow rounded-lg p-5">
                <h2 class="text-gray-500">Users</h2>
                <p class="text-2xl font-semibold">{{ $stats['total_users'] }}</p>
                <a href="{{ route('users.index') }}" class="text-blue-500 hover:underline text-sm mt-2 block">Manage Users</a>
            </div>

            <div class="bg-white shadow rounded-lg p-5">
                <h2 class="text-gray-500">Categories</h2>
                <p class="text-2xl font-semibold">--</p>
                <a href="{{ route('categories.index') }}" class="text-blue-500 hover:underline text-sm mt-2 block">Manage Categories</a>
            </div>

            <div class="bg-white shadow rounded-lg p-5">
                <h2 class="text-gray-500">Courses</h2>
                <p class="text-2xl font-semibold">{{ $stats['total_courses'] }}</p>
                <a href="{{ route('courses.index') }}" class="text-blue-500 hover:underline text-sm mt-2 block">Manage Courses</a>
            </div>

            <div class="bg-white shadow rounded-lg p-5">
                <h2 class="text-gray-500">Enrollments</h2>
                <p class="text-2xl font-semibold">{{ $stats['total_enrollments'] }}</p>
            </div>
        </div>

        <!-- Teacher Requests -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">📩 Teacher Requests</h3>
            <a href="{{ route('admin.teacher.requests') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                View Requests
            </a>
        </div>

        <!-- Latest Courses -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">📝 Latest Courses</h3>
            <ul class="space-y-2">
                @foreach($courses as $course)
                    <li class="border-b pb-2">
                        <span class="font-medium">{{ $course->title }}</span>
                        ({{ $course->enrollments_count }} students) - Teacher: <span class="text-blue-600">{{ $course->teacher->name }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Latest Users -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">👤 Latest Users</h3>
            <ul class="space-y-2">
                @foreach($users as $user)
                    <li class="border-b pb-2">
                        <span class="font-medium">{{ $user->name }}</span> ({{ $user->role }})
                        - Courses: {{ $user->courses_count ?? 0 }}
                        - Enrollments: {{ $user->enrollments_count ?? 0 }}
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Latest Enrollments -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h3 class="text-lg font-semibold mb-4">🎓 Latest Enrollments</h3>
            <ul class="space-y-2">
                @foreach($enrollments as $enroll)
                    <li class="border-b pb-2">
                        <span class="font-medium">{{ $enroll->user->name }}</span> →
                        <span class="text-blue-600">{{ $enroll->course->title }}</span>
                        ({{ ucfirst($enroll->status) }})
                    </li>
                @endforeach
            </ul>
        </div>

    </div>
@endsection
