@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">📂 Categories</h2>
        <a href="{{ route('categories.create') }}"
           class="px-4 py-2 bg-green-500 text-white rounded-lg shadow hover:bg-green-600 transition">
            + Add Category
        </a>
    </div>

    @if($categories->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($categories as $category)
                <div class="bg-white shadow rounded-lg p-5 flex flex-col justify-between hover:shadow-md transition">
                    <h3 class="text-lg font-semibold text-gray-700">{{ $category->name }}</h3>

                    <div class="mt-4 flex justify-between items-center">
                        <a href="{{ route('categories.edit', $category) }}"
                           class="px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-sm">
                            Edit
                        </a>
                        <form action="{{ route('categories.destroy', $category) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-lg mt-4">
            🚀 No categories found. Add your first category!
        </div>
    @endif
@endsection
