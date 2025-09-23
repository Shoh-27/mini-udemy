@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Kategoriyani tahrirlash</h2>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Kategoriya nomi</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $category->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Yangilash</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Orqaga</a>
        </form>
    </div>
@endsection

