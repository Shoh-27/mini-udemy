@extends('layouts.app')

@section('content')
    <div>
        <!-- Kurs ma'lumotlari -->
        <h2 class="text-3xl font-bold text-gray-800 mb-4">{{ $course->title }}</h2>
        <p class="text-gray-700 mb-2">{{ $course->description }}</p>
        <p class="text-lg font-semibold text-indigo-600 mb-4">💲 Narxi: ${{ $course->price }}</p>

        @if($course->image)
            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="w-64 rounded shadow mb-6">
        @endif
        <!-- Lessons -->
        <div class="flex items-center justify-between mb-4">
            <h4 class="text-xl font-semibold text-gray-800">📖 Darslar ({{ $course->lessons->count() }})</h4>

            @role('teacher')
            <a href="{{ route('teacher.lessons.create', $course->id) }}"
               class="px-4 py-2 bg-indigo-500 text-white rounded-md shadow hover:bg-indigo-600">
                ➕ Yangi dars qo‘shish
            </a>
            @endrole
        </div>

        <!-- Lesson list -->
        @forelse($course->lessons as $lesson)
            <div class="bg-white border rounded-lg shadow-sm p-4 mb-4">
                <h5 class="text-lg font-bold text-gray-900">{{ $lesson->title }}</h5>
                <p class="text-gray-600 mb-2">{{ $lesson->description }}</p>

                @if($lesson->video)
                    <video controls class="w-full max-w-xl rounded shadow my-3">
                        <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @endif

                <div class="flex space-x-2 mt-3">
                    <a href="{{ route('teacher.lessons.edit', $lesson->id) }}"
                       class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600 text-sm">
                        ✏️ Tahrirlash
                    </a>
                    <form action="{{ route('teacher.lessons.destroy', $lesson->id) }}" method="POST"
                          onsubmit="return confirm('Bu darsni o‘chirishni xohlaysizmi?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                            🗑️ O‘chirish
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-gray-500 italic">📌 Hali darslar qo‘shilmagan.</p>
        @endforelse
    </div>
@endsection
