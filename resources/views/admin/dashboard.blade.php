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

        <h2 class="text-3xl font-bold mb-6">Admin Dashboard</h2>

        <!-- Summary Cards -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-blue-600 text-white rounded-xl p-6 shadow">
                <h3 class="text-lg font-semibold">Total Authors</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalAuthors }}</p>
            </div>

            <div class="bg-green-600 text-white rounded-xl p-6 shadow">
                <h3 class="text-lg font-semibold">Total Categories</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
            </div>

            <div class="bg-purple-600 text-white rounded-xl p-6 shadow">
                <h3 class="text-lg font-semibold">Total Posts</h3>
                <p class="text-3xl font-bold mt-2">{{ $totalPosts }}</p>
            </div>
        </div>

        <!-- Assign Category Form -->
        <div class="bg-white shadow-lg rounded-xl p-6 mb-8">
            <h3 class="text-2xl font-bold mb-4">Assign Category to Author</h3>

            <form method="POST" action="{{ route('admin.assign.category') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-2 font-medium">Select Author</label>
                    <select name="user_id" class="w-full border rounded-lg p-3">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">
                                {{ $author->name }} ({{ $author->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block mb-2 font-medium">Select Category</label>
                    <select name="category_id" class="w-full border rounded-lg p-3">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
                    Assign Category
                </button>
            </form>
        </div>

        <!-- Author Category List -->
        <div class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-2xl font-bold mb-4">Authors and Assigned Categories</h3>

            @forelse($authors as $author)
                <div class="border-b py-4">
                    <h4 class="font-semibold text-lg">{{ $author->name }}</h4>
                    <p class="text-sm text-gray-500 mb-2">{{ $author->email }}</p>

                    <div class="flex flex-wrap gap-2">
                        @forelse($author->categories as $category)
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                {{ $category->name }}
                            </span>
                        @empty
                            <span class="text-gray-400 text-sm">No category assigned</span>
                        @endforelse
                    </div>
                </div>
            @empty
                <p>No authors found.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>