<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// Home route
Route::get('/', [NewsController::class, 'home'])->name('home');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// News Routes (Public access for reading, Auth required for writing)
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news_id}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('auth')->group(function () {
    // News management (requires authentication)
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news_id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{news_id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news_id}', [NewsController::class, 'destroy'])->name('news.destroy');
    
    // Comment Routes (requires authentication)
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment_id}', [CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/{comment_id}/hide', [CommentController::class, 'hide'])->name('comments.hide');
    Route::delete('/comments/{comment_id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Company Profile Routes (Public for viewing, Auth for editing)
Route::get('/company-profile', [CompanyProfileController::class, 'show'])->name('company.profile.show');

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Company profile management (admin only)
    Route::get('/company-profile/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
    Route::put('/company-profile', [CompanyProfileController::class, 'update'])->name('company.profile.update');
});

// User Management Routes (Admin only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{nip}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{nip}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{nip}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{nip}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/users/{nip}/change-password', [UserController::class, 'changePassword'])->name('users.change.password');
});

// Profile Routes (Self management)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.show');
    Route::get('/profile/edit', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/change-password', [UserController::class, 'changeOwnPassword'])->name('profile.change.password');
});

// API Routes (untuk AJAX requests)
Route::prefix('api')->middleware('auth')->group(function () {
    Route::get('/news/search', [NewsController::class, 'search'])->name('api.news.search');
    Route::get('/comments/{news_id}', [CommentController::class, 'getByNews'])->name('api.comments.by.news');
    Route::post('/comments/{comment_id}/toggle-visibility', [CommentController::class, 'toggleVisibility'])->name('api.comments.toggle.visibility');
});
