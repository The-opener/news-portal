<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-gradient-to-r from-blue-700 via-indigo-700 to-purple-700 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-extrabold tracking-wide">📰 News Portal</h1>
                <p class="text-sm text-blue-100">Fresh stories, every day</p>
            </div>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-yellow-300 font-medium transition">
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-yellow-300 font-medium transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="bg-white text-indigo-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="bg-gradient-to-r from-indigo-800 via-blue-700 to-cyan-600 text-white">
        <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-2 gap-10 items-center">
            <div>
                <p class="uppercase tracking-[0.3em] text-sm text-blue-200 mb-3">Top Stories</p>
                <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                    Stay Updated With The Latest News
                </h2>
                <p class="text-lg text-blue-100 mb-6">
                    Read business, sports, and technology news from different authors in one place.
                </p>

                <div class="flex gap-4">
                    <a href="#latest-news" class="bg-white text-indigo-700 px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition">
                        Explore News
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="border border-white px-6 py-3 rounded-xl font-semibold hover:bg-white hover:text-indigo-700 transition">
                            Join Now
                        </a>
                    @endguest
                </div>
            </div>

            <div class="bg-white/10 backdrop-blur-md rounded-2xl p-8 shadow-2xl">
                <div class="grid grid-cols-1 gap-4">
                    <div class="bg-white/10 rounded-xl p-4">
                        <h3 class="font-bold text-xl mb-1">Business News</h3>
                        <p class="text-blue-100 text-sm">Market updates, economy, and business insights.</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4">
                        <h3 class="font-bold text-xl mb-1">Sports News</h3>
                        <p class="text-blue-100 text-sm">Latest highlights, scores, and sports stories.</p>
                    </div>
                    <div class="bg-white/10 rounded-xl p-4">
                        <h3 class="font-bold text-xl mb-1">Technology</h3>
                        <p class="text-blue-100 text-sm">Trends, gadgets, and innovation updates.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="latest-news" class="max-w-7xl mx-auto px-6 py-12">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl font-extrabold">Latest News</h2>
                <p class="text-gray-500 mt-1">Discover recent posts from our authors</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($posts as $post)
                <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 border border-gray-100">

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             alt="Post Image"
                             class="w-full h-52 object-cover">
                    @else
                        <div class="w-full h-52 bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                            {{ $post->category->name }}
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                                {{ $post->category->name }}
                            </span>
                            <span class="text-sm text-gray-400">
                                {{ $post->created_at->format('M d, Y') }}
                            </span>
                        </div>

                        <h3 class="text-xl font-bold mb-3 leading-snug">
                            {{ $post->title }}
                        </h3>

                        <p class="text-gray-600 mb-4">
                            {{ \Illuminate\Support\Str::limit($post->content, 120) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500">
                                By <span class="font-semibold text-gray-700">{{ $post->user->name }}</span>
                            </p>

                            <button
    type="button"
    class="text-indigo-600 font-semibold hover:text-indigo-800 transition"
    onclick="openPostModal(
        '{{ addslashes($post->title) }}',
        '{{ addslashes($post->category->name) }}',
        '{{ addslashes($post->user->name) }}',
        '{{ $post->created_at->format('M d, Y') }}',
        `{{ addslashes($post->content) }}`,
        '{{ $post->image ? asset('storage/' . $post->image) : '' }}'
    )"
>
    Read More
</button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-2xl shadow p-12 text-center">
                        <h3 class="text-2xl font-bold mb-2">No News Available Yet</h3>
                        <p class="text-gray-500">Posts will appear here once authors publish news.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <div id="postModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 px-4">
        <div class="bg-white w-full max-w-3xl rounded-2xl shadow-2xl overflow-hidden relative max-h-[90vh] overflow-y-auto">

            <button onclick="closePostModal()" class="absolute top-4 right-4 bg-red-500 text-white w-10 h-10 rounded-full hover:bg-red-600 z-10">
                ✕
            </button>

            <img id="modalImage" src="" alt="Post Image" class="w-full h-72 object-cover hidden">

            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <span id="modalCategory" class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full"></span>
                    <span id="modalDate" class="text-sm text-gray-500"></span>
                </div>

                <h2 id="modalTitle" class="text-3xl font-bold mb-3"></h2>

                <p class="text-gray-500 mb-6">
                    By <span id="modalAuthor" class="font-semibold text-gray-700"></span>
                </p>

                <div id="modalContent" class="text-gray-700 leading-8 whitespace-pre-line"></div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 text-gray-300 mt-12">
        <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <div>
                <h3 class="text-xl font-bold text-white">News Portal</h3>
                <p class="text-sm text-gray-400">Your daily source for Business, Sports, and Technology news.</p>
            </div>
            <p class="text-sm text-gray-400">© {{ date('Y') }} News Portal. All rights reserved.</p>
        </div>
    </footer>

    <script>
        function openPostModal(title, category, author, date, content, image) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalCategory').textContent = category;
    document.getElementById('modalAuthor').textContent = author;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalContent').textContent = content;

    const modalImage = document.getElementById('modalImage');

    if (image) {
        modalImage.src = image;
        modalImage.classList.remove('hidden');
    } else {
        modalImage.src = '';
        modalImage.classList.add('hidden');
    }

    const modal = document.getElementById('postModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

        function closePostModal() {
            const modal = document.getElementById('postModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        window.addEventListener('click', function (e) {
            const modal = document.getElementById('postModal');
            if (e.target === modal) {
                closePostModal();
            }
        });
        '{{ $post->image ? asset('storage/' . $post->image) : '' }}'
    </script>

</body>
</html>
