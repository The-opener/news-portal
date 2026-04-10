<x-app-layout>
    <div class="p-6">
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
    <h2 class="text-2xl font-bold mb-4">Create News</h2>

    <form method="POST" action="{{ route('author.posts.store') }}" class="space-y-4">
        @csrf

        <input type="text" name="title" placeholder="Title"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">

        <textarea name="content" rows="5" placeholder="Write your news..."
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400"></textarea>

        <select name="category_id"
            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
            Publish
        </button>
    </form>
</div>
                </form>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-xl font-semibold mb-4">My Posts</h3>

                @forelse($posts as $post)
                    <div class="border-b py-4">
                        <h4 class="text-lg font-bold">{{ $post->title }}</h4>
                        <p class="text-sm text-gray-500 mb-2">{{ $post->category->name }}</p>
                        <p>{{ $post->content }}</p>
                    </div>
                @empty
                    <p>No posts yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>