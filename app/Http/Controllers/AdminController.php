<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $authors = User::where('role', 'author')->with('categories')->get();
        $categories = Category::all();
        $totalAuthors = User::where('role', 'author')->count();
        $totalCategories = Category::count();
        $totalPosts = Post::count();

        return view('admin.dashboard', compact(
            'authors',
            'categories',
            'totalAuthors',
            'totalCategories',
            'totalPosts'
        ));
    }

    public function assignCategory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = User::findOrFail($request->user_id);

        $user->categories()->syncWithoutDetaching([$request->category_id]);

        return back()->with('success', 'Category assigned successfully.');
    }
}