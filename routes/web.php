<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->check() && auth()->user()->role === 'author') {
        return redirect()->route('author.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/assign-category', [AdminController::class, 'assignCategory'])->name('admin.assign.category');
});

Route::middleware(['auth', 'author'])->group(function () {
    Route::get('/author/dashboard', [PostController::class, 'dashboard'])->name('author.dashboard');
    Route::post('/author/posts', [PostController::class, 'store'])->name('author.posts.store');
    Route::delete('/author/posts/{post}', [PostController::class, 'destroy'])->name('author.posts.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';