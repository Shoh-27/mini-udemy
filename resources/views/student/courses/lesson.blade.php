@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                {{ $lesson->title }}
            </h2>

            <div class="prose max-w-none mb-6 text-gray-700">
                {!! nl2br(e($lesson->content)) !!}
            </div>

            @if($lesson->video)
                <div class="mb-6">
                    <video controls class="w-full rounded-lg shadow-md">
                        <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                        Sizning brauzeringiz videoni qo‘llab-quvvatlamaydi.
                    </video>
                </div>
            @endif

            <a href="{{ route('student.courses.show', $course->id) }}"
               class="inline-block px-4 py-2 bg-gray-600 text-white text-sm rounded hover:bg-gray-700 transition">
                ⬅️ Kursga qaytish
            </a>
        </div>
    </div>
@endsection


