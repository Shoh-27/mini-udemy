@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Yangi kategoriya qo‘shish</h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Kategoriya nomi</label>
                <input type="text" name="name" id="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Saqlash</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Orqaga</a>
        </form>
    </div>
@endsection

