@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Course</h2>
        <form action="{{ route('teacher.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="title" placeholder="Title" class="form-control mb-2" required>
            <textarea name="description" placeholder="Description" class="form-control mb-2"></textarea>
            <input type="number" step="0.01" name="price" placeholder="Price" class="form-control mb-2" required>
            <input type="file" name="image" class="form-control mb-2">
            <button class="btn btn-success">Save</button>
        </form>
    </div>
@endsection

