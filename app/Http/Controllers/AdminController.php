<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $authors = User::where('role', 'author')->get();
        $categories = Category::all();

        return view('admin.dashboard', compact('authors', 'categories'));
    }

    public function assignCategory(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->categories()->syncWithoutDetaching([$request->category_id]);

        return redirect()->back()->with('success', 'Category assigned successfully.');
    }
}