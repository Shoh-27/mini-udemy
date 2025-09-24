@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Lesson to {{ $course->title }}</h2>
        <form action="{{ route('teacher.lessons.store', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Lesson Title" class="form-control mb-2" required>
            <textarea name="content" placeholder="Lesson Content" class="form-control mb-2"></textarea>
            <input type="file" name="video" accept="video/*" class="form-control mb-2">
            <button class="btn btn-success">Add Lesson</button>
        </form>
    </div>
@endsection

