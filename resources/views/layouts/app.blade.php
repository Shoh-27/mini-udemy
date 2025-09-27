<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mini Udemy') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

<!-- Navigation -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold text-gray-800">
                    {{ config('app.name', 'Mini Udemy') }}
                </a>
            </div>
            <div class="flex items-center space-x-4">
                @auth
                    <span class="text-gray-600">Hello, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-3 py-2 rounded-md text-sm font-medium bg-red-500 text-white hover:bg-red-600">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Page Heading -->
@isset($header)
    <header class="bg-gradient-to-r from-indigo-500 to-purple-600 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-white text-2xl font-semibold">{{ $header }}</h1>
        </div>
    </header>
@endisset

<!-- Page Content -->
<main class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            @yield('content')
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 mt-10">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-center text-gray-300">
        &copy; {{ date('Y') }} {{ config('app.name', 'Mini Udemy') }}. All rights reserved.
    </div>
</footer>

</body>
</html>
