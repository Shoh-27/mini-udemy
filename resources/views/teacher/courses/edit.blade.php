@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Course</h2>
        <form action="{{ route('teacher.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <input type="text" name="title" value="{{ $course->title }}" class="form-control mb-2" required>
            <textarea name="description" class="form-control mb-2">{{ $course->description }}</textarea>
            <input type="number" step="0.01" name="price" value="{{ $course->price }}" class="form-control mb-2" required>

            @if($course->image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $course->image) }}" width="150" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control mb-2">

            <button class="btn btn-warning">Update</button>
        </form>
    </div>
@endsection

