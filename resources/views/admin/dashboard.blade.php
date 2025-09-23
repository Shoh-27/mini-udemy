@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Panel</h1>
        <ul>
            <li><a href="{{ route('users.index') }}">Users</a></li>
            <li><a href="{{ route('categories.index') }}">Categories</a></li>
        </ul>
    </div>
@endsection

