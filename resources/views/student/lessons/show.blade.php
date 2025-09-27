@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $lesson->title }}</h1>
        <p>{{ $lesson->content }}</p>

        @if($lesson->video)
            <video width="640" controls>
                <source src="{{ asset('storage/lessons/' . $lesson->video) }}" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        @endif
    </div>
@endsection

