@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">📚 Barcha kurslar</h2>

        <div class="space-y-6">
            @forelse($courses as $course)
                <div class="bg-white shadow rounded-lg p-6 border border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                                {{ $course->title }}
                                <span class="px-2 py-1 text-xs rounded-full
                                    @if($course->status === 'approved') bg-green-100 text-green-700
                                    @elseif($course->status === 'rejected') bg-red-100 text-red-700
                                    @else bg-yellow-100 text-yellow-700 @endif">
                                    {{ ucfirst($course->status) }}
                                </span>
                            </h3>
                            <p class="text-gray-600 mt-2">{{ Str::limit($course->description, 150) }}</p>
                            <p class="mt-3 text-sm text-gray-500">
                                👨‍🏫 <strong>O‘qituvchi:</strong> {{ $course->user->name }}
                            </p>
                        </div>

                        <a href="{{ route('admin.courses.show', $course->id) }}"
                           class="px-3 py-1 bg-blue-500 text-white text-sm rounded-lg shadow hover:bg-blue-600 transition">
                            👁 View
                        </a>
                    </div>

                    @if($course->status === 'pending')
                        <div class="mt-4 flex gap-3">
                            <form action="{{ route('admin.courses.approve', $course->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="px-4 py-2 bg-green-500 text-white text-sm rounded-lg shadow hover:bg-green-600 transition">
                                    ✅ Approve
                                </button>
                            </form>
                            <form action="{{ route('admin.courses.reject', $course->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button class="px-4 py-2 bg-red-500 text-white text-sm rounded-lg shadow hover:bg-red-600 transition">
                                    ❌ Reject
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 px-4 py-3 rounded-lg">
                    Hozircha kurslar mavjud emas.
                </div>
            @endforelse
        </div>
    </div>
@endsection
