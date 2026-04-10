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
        ]);

        $user = Auth::user();

        $allowedCategoryIds = $user->categories->pluck('id')->toArray();

        if (!in_array($request->category_id, $allowedCategoryIds)) {
            return redirect()->back()->with('error', 'You are not allowed to post in this category.');
        }

        Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);

        return redirect()->back()->with('success', 'Post created successfully.');
    }
}