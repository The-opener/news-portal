
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

       <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="bg-white shadow-lg rounded-xl p-6">
    <h2 class="text-2xl font-bold mb-6">Assign Categories</h2>

    <form method="POST" action="{{ route('admin.assign.category') }}" class="space-y-4">
        @csrf

        <select name="user_id" class="w-full border rounded-lg p-3">
            @foreach($authors as $author)
                <option value="{{ $author->id }}">
                    {{ $author->name }}
                </option>
            @endforeach
        </select>

        <select name="category_id" class="w-full border rounded-lg p-3">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700">
            Assign
        </button>
    </form>
</div>

        </div>
    </div>
</x-app-layout>