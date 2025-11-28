<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/png/{slug}', [App\Http\Controllers\ImageController::class, 'show'])->name('image.show');
Route::get('/download/{image}', [App\Http\Controllers\ImageController::class, 'download'])->name('image.download');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::get('/upload', [App\Http\Controllers\UploadController::class, 'showForm'])->name('upload.form');
Route::post('/upload', [App\Http\Controllers\UploadController::class, 'store'])->name('upload.store')->middleware('auth');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('register');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware('auth')->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->middleware('admin')->name('admin.dashboard');
    Route::post('/admin/approve/{image}', [App\Http\Controllers\AdminController::class, 'approveImage'])->middleware('admin')->name('admin.approve');
    Route::post('/admin/reject/{image}', [App\Http\Controllers\AdminController::class, 'rejectImage'])->middleware('admin')->name('admin.reject');
    
    // User profile pages
    Route::get('/my-uploads', [App\Http\Controllers\UserController::class, 'myUploads'])->name('user.uploads');
    Route::get('/favorites', [App\Http\Controllers\UserController::class, 'favorites'])->name('user.favorites');
    Route::post('/favorites/toggle', [App\Http\Controllers\UserController::class, 'toggleFavorite'])->name('favorites.toggle');
    Route::get('/settings', [App\Http\Controllers\UserController::class, 'settings'])->name('user.settings');
});
