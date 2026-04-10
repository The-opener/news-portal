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

        <div class="bg-blue-600 text-white p-6 rounded-xl shadow mb-6">
            <h2 class="text-xl font-bold">My Dashboard</h2>
            <p class="text-3xl font-bold mt-2">{{ $posts->count() }} Posts</p>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-bold mb-4">Create News</h2>

            @if($categories->isEmpty())
                <p class="text-red-500 mb-4">
                    No category assigned. Contact admin.
                </p>
            @endif

            <form method="POST" action="{{ route('author.posts.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <input type="text" name="title" placeholder="Title"
                    class="w-full border rounded-lg p-3" required>

                <textarea name="content" rows="5" id="contentBox"
                    placeholder="Write your news..."
                    class="w-full border rounded-lg p-3" required></textarea>

                <p class="text-sm text-gray-500">
                    Characters: <span id="charCount">0</span>
                </p>

                <input type="file" name="image" id="imageInput"
                    class="w-full border rounded-lg p-3">

                <img id="previewImage" class="w-40 mt-2 hidden rounded">

                <select name="category_id" class="w-full border rounded-lg p-3" required>
                    @forelse($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @empty
                        <option disabled>No category</option>
                    @endforelse
                </select>

                <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded-lg">
                    Publish
                </button>
            </form>
        </div>

        <div class="bg-white shadow rounded p-6">
            <h3 class="text-xl font-semibold mb-4">My Posts</h3>

            @forelse($posts as $post)
                <div class="border-b py-4 flex gap-4 items-start">

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}"
                             class="w-24 h-24 object-cover rounded">
                    @endif

                    <div class="flex-1">
                        <h4 class="font-bold">{{ $post->title }}</h4>
                        <p class="text-sm text-gray-500">{{ $post->category->name }}</p>
                        <p>{{ \Illuminate\Support\Str::limit($post->content, 80) }}</p>
                    </div>

                    <form method="POST"
                          action="{{ route('author.posts.destroy', $post->id) }}"
                          onsubmit="return confirm('Delete post?')">
                        @csrf
                        @method('DELETE')

                        <button class="bg-red-600 text-white px-3 py-1 rounded">
                            Delete
                        </button>
                    </form>

                </div>
            @empty
                <p>No posts yet.</p>
            @endforelse
        </div>

    </div>

    <script>
        const contentBox = document.getElementById('contentBox');
        const charCount = document.getElementById('charCount');

        if (contentBox && charCount) {
            contentBox.addEventListener('input', () => {
                charCount.textContent = contentBox.value.length;
            });
        }

        const imageInput = document.getElementById('imageInput');
        const previewImage = document.getElementById('previewImage');

        if (imageInput && previewImage) {
            imageInput.addEventListener('change', function() {
                const file = this.files[0];

                if (file) {
                    previewImage.src = URL.createObjectURL(file);
                    previewImage.classList.remove('hidden');
                }
            });
        }
    </script>
</x-app-layout>