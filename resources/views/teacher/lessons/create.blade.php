@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Add Lesson to "{{ $course->title }}"</h2>

        <form action="{{ route('teacher.lessons.store', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Lesson Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('title') border-red-500 @enderror"
                       placeholder="Enter lesson title" required>
                @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lesson Content -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Lesson Content</label>
                <textarea id="content" name="content" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 @error('content') border-red-500 @enderror"
                          placeholder="Write lesson content...">{{ old('content') }}</textarea>
                @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Upload Video -->
            <div>
                <label for="video" class="block text-sm font-medium text-gray-700">Upload Video</label>
                <input type="file" id="video" name="video" accept="video/*"
                       class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('video') border-red-500 @enderror">
                @error('video')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    ➕ Add Lesson
                </button>
            </div>
        </form>
    </div>
@endsection
