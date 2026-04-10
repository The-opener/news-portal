<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
<nav class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-4 shadow">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">📰 News Portal</h1>

        <div class="space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>

                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-500 px-3 py-1 rounded hover:bg-red-600">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-6 text-center">Latest News</h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-5">
                <h3 class="text-xl font-bold mb-2">{{ $post->title }}</h3>

                <p class="text-sm text-gray-500 mb-2">
                    {{ $post->category->name }} • {{ $post->user->name }}
                </p>

                <p class="text-gray-700">
                    {{ Str::limit($post->content, 120) }}
                </p>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>