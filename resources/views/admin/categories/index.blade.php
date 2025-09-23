@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Categories</h2>
        <a href="{{ route('categories.create') }}">+ Add Category</a>
        <ul>
            @foreach($categories as $category)
                <li>
                    {{ $category->name }}
                    <a href="{{ route('categories.edit', $category) }}">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

