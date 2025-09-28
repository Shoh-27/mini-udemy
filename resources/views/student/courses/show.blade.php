<div class="mt-6">
    <h4 class="text-lg font-semibold mb-3">📚 Darslar</h4>

    @if($course->students->contains(auth()->id()))
        @forelse($course->lessons as $lesson)
            <div class="bg-white border border-gray-200 rounded-lg shadow-sm mb-3 p-4 flex justify-between items-center">
                <span class="text-gray-700 font-medium">{{ $lesson->title }}</span>
                <a href="{{ route('student.courses.lessons.show', [$course->id, $lesson->id]) }}"
                   class="px-3 py-1 text-sm bg-indigo-500 text-white rounded hover:bg-indigo-600 transition">
                    📖 O‘qish
                </a>
            </div>
        @empty
            <p class="text-gray-500 italic">❌ Hali darslar qo‘shilmagan.</p>
        @endforelse
    @else
        <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-lg p-4">
            📌 Darslarni ko‘rish uchun avval kursga yoziling.
        </div>
    @endif
</div>


