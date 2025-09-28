@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        <!-- Course header -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="md:flex md:items-start md:justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $course->title }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Oʻqituvchi:
                        <span class="font-medium text-gray-700">{{ $course->teacher->name ?? $course->user->name ?? 'Aniqlanmagan' }}</span>
                    </p>
                    <p class="mt-3 text-gray-700">{{ $course->description }}</p>

                    <div class="mt-4 flex flex-wrap items-center gap-3">
                        <span class="text-lg font-semibold text-indigo-600">💲 ${{ number_format($course->price, 2) }}</span>

                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($course->status === 'approved') bg-green-100 text-green-800
                        @elseif($course->status === 'pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800 @endif">
                        {{ ucfirst($course->status ?? 'pending') }}
                    </span>

                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm text-gray-500">Lessons: <span class="font-medium">{{ $course->lessons->count() }}</span></span>
                        <span class="text-sm text-gray-500">•</span>
                        <span class="text-sm text-gray-500">Enrolled: <span class="font-medium">{{ $course->enrollments->count() ?? 0 }}</span></span>
                    </div>
                </div>

                <div class="mt-4 md:mt-0 md:text-right">
                    @if($course->image)
                        <img src="{{ asset('storage/' . $course->image) }}" alt="Course image" class="w-48 h-32 object-cover rounded shadow-sm mx-auto md:mx-0">
                    @else
                        <div class="w-48 h-32 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                            No image
                        </div>
                    @endif

                    <div class="mt-3 flex flex-col gap-2">
                        @role('admin')
                        @if($course->status === 'pending')
                            <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="w-full inline-flex justify-center items-center px-3 py-2 bg-green-600 text-white text-sm rounded hover:bg-green-700">
                                    ✅ Approve
                                </button>
                            </form>

                            <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <button class="w-full inline-flex justify-center items-center px-3 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                    ❌ Reject
                                </button>
                            </form>
                        @endif
                        <a href="{{ route('admin.courses.index') }}" class="mt-2 text-sm text-indigo-600 hover:underline">← Back to courses</a>
                        @endrole

                        @role('teacher')
                        @if(auth()->id() === $course->user_id)
                            <a href="{{ route('teacher.courses.edit', $course->id) }}" class="inline-flex justify-center px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
                                ✏️ Edit course
                            </a>
                            <a href="{{ route('teacher.lessons.create', $course->id) }}" class="inline-flex justify-center px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                                ➕ Add lesson
                            </a>
                        @endif
                        @endrole

                        @role('student')
                        @if(!$course->students->contains(auth()->id()))
                            <form action="{{ route('student.courses.enroll', $course->id) }}" method="POST">
                                @csrf
                                <button class="w-full inline-flex justify-center px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 text-sm">
                                    📚 Enroll course
                                </button>
                            </form>
                        @else
                            <span class="inline-flex justify-center px-3 py-2 bg-green-100 text-green-800 rounded text-sm">✅ You are enrolled</span>
                        @endif
                        @endrole
                    </div>
                </div>
            </div>
        </div>

        <!-- Lessons list -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">📖 Lessons ({{ $course->lessons->count() }})</h3>
                @role('teacher')
                @if(auth()->id() === $course->user_id)
                    <a href="{{ route('teacher.lessons.create', $course->id) }}" class="text-sm bg-indigo-500 text-white px-3 py-1 rounded hover:bg-indigo-600">+ Add Lesson</a>
                @endif
                @endrole
            </div>

            @if($course->students->contains(auth()->id()) || auth()->user()->hasRole('admin') || (auth()->user()->hasRole('teacher') && auth()->id() === $course->user_id))
                @forelse($course->lessons as $lesson)
                    <div class="border-b last:border-b-0 py-4 flex justify-between items-center">
                        <div>
                            <h4 class="text-md font-medium text-gray-800">{{ $lesson->title }}</h4>
                            @if($lesson->content)
                                <p class="text-sm text-gray-600 mt-1">{{ Str::limit($lesson->content, 140) }}</p>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            @role('student')
                            <a href="{{ route('student.courses.lessons.show', [$course->id, $lesson->id]) }}" class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">📖 Read</a>
                            @else
                                <a href="{{ route('teacher.lessons.edit', $lesson->id) }}" class="px-3 py-1 bg-yellow-400 text-white text-sm rounded hover:bg-yellow-500">✏️ Edit</a>
                                <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Delete this lesson?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">🗑 Delete</button>
                                </form>
                                @endrole
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Hozircha darslar mavjud emas.</p>
                @endforelse
            @else
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded">
                    📌 Darslarni ko‘rish uchun avval kursga yoziling.
                </div>
            @endif
        </div>

        <!-- Enrollments list (teachers & admin) -->
        @if(auth()->user()->hasRole('teacher') && auth()->id() === $course->user_id || auth()->user()->hasRole('admin'))
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold mb-3">👥 Enrolled Students ({{ $course->enrollments->count() }})</h3>

                @if($course->enrollments->isEmpty())
                    <p class="text-gray-500">Hali hech kim yozilmagan.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($course->enrollments as $enroll)
                            <li class="flex items-center justify-between border-b last:border-b-0 py-2">
                                <div>
                                    <div class="font-medium text-gray-800">{{ $enroll->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $enroll->user->email }}</div>
                                </div>
                                <div class="text-sm">
                                <span class="px-2 py-1 rounded text-xs font-medium
                                    @if($enroll->status === 'active') bg-green-100 text-green-700
                                    @elseif($enroll->status === 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ ucfirst($enroll->status) }}
                                </span>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif
    </div>
@endsection
