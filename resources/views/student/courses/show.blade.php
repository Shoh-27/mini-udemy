<div class="mt-4">
    <h4>Darslar</h4>

    @if($course->students->contains(auth()->id()))
        @forelse($course->lessons as $lesson)
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between">
                    <span>{{ $lesson->title }}</span>
                    <a href="{{ route('student.courses.lessons.show', [$course->id, $lesson->id]) }}" class="btn btn-sm btn-primary">
                        📖 O‘qish
                    </a>
                </div>
            </div>
        @empty
            <p class="text-muted">Hali darslar qo‘shilmagan.</p>
        @endforelse
    @else
        <p class="alert alert-warning">📌 Darslarni ko‘rish uchun avval kursga yoziling.</p>
    @endif
</div>

