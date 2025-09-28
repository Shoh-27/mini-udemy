@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Kategoriyani tahrirlash</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Input field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Kategoriya nomi</label>
                <input type="text" name="name" id="name"
                       class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                              @error('name') border-red-500 @enderror"
                       value="{{ old('name', $category->name) }}" required>

                @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-3">
                <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
                    ✅ Yangilash
                </button>
                <a href="{{ route('categories.index') }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400 transition">
                    ↩️ Orqaga
                </a>
            </div>
        </form>
    </div>
@endsection
