<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category'])->latest()->get();
        return view('welcome', compact('posts'));
    }

    public function dashboard()
    {
        $categories = Auth::user()->categories;
        $posts = Auth::user()->posts()->with('category')->latest()->get();

        return view('author.dashboard', compact('categories', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        $allowedCategoryIds = $user->categories->pluck('id')->toArray();

        if (!in_array((int) $request->category_id, $allowedCategoryIds)) {
            return redirect()->back()->with('error', 'You are not allowed to post in this category.');
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Post created successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'You can only delete your own posts.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}