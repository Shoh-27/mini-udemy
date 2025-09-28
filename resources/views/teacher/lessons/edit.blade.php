@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6 text-gray-800">
        Edit Lesson in {{ $course->title }}
    </h2>

    <form action="{{ route('teacher.lessons.update', $lesson->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
            <input type="text" id="title" name="title"
                   value="{{ old('title', $lesson->title) }}"
                   required
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                          focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
        </div>

        <!-- Content -->
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Lesson Content</label>
            <textarea id="content" name="content" rows="5"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                             focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('content', $lesson->content) }}</textarea>
        </div>

        <!-- Current Video -->
        @if($lesson->video)
            <div>
                <p class="text-sm text-gray-600 mb-2">Current Video:</p>
                <video width="400" controls class="rounded-lg shadow">
                    <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        @endif

        <!-- Upload new video -->
        <div>
            <label for="video" class="block text-sm font-medium text-gray-700">Upload New Video</label>
            <input type="file" id="video" name="video" accept="video/*"
                   class="mt-1 block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-600
                          hover:file:bg-indigo-100">
        </div>

        <!-- Submit button -->
        <div>
            <button type="submit"
                    class="px-4 py-2 bg-yellow-500 text-white rounded-md
                           shadow hover:bg-yellow-600 focus:outline-none
                           focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                Update Lesson
            </button>
        </div>
    </form>
@endsection
