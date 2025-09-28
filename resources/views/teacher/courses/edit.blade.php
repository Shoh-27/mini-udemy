@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Kursni tahrirlash</h2>

    <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Sarlavha</label>
            <input type="text" name="title" id="title" value="{{ $course->title }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   required>
        </div>

        <!-- Description -->
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Tavsif</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ $course->description }}</textarea>
        </div>

        <!-- Price -->
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Narxi ($)</label>
            <input type="number" step="0.01" name="price" id="price" value="{{ $course->price }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                   required>
        </div>

        <!-- Current Image -->
        @if($course->image)
            <div>
                <p class="text-sm text-gray-600 mb-1">Hozirgi rasm:</p>
                <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="w-40 rounded shadow mb-2">
            </div>
        @endif

        <!-- Upload New Image -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Yangi rasm yuklash</label>
            <input type="file" name="image" id="image"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0 file:text-sm file:font-semibold
                          file:bg-indigo-50 file:text-indigo-700
                          hover:file:bg-indigo-100">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-yellow-500 text-white rounded-md shadow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-400">
                🔄 Yangilash
            </button>
        </div>
    </form>
@endsection
