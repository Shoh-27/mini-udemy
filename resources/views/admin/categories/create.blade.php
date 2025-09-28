@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto">
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">➕ Yangi kategoriya qo‘shish</h2>

            <form action="{{ route('categories.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Input -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Kategoriya nomi</label>
                    <input type="text" name="name" id="name"
                           class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                  @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}" required>

                    @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-3">
                    <button type="submit"
                            class="px-4 py-2 bg-indigo-500 text-white rounded-lg shadow hover:bg-indigo-600 transition">
                        💾 Saqlash
                    </button>
                    <a href="{{ route('categories.index') }}"
                       class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg shadow hover:bg-gray-400 transition">
                        ↩️ Orqaga
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
