<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/home', function () {
    return 'Hello, World!';
});

// dashboard pages
Route::get('/admin', function () {
    return view('pages.dashboard.welcome-page', ['title' => 'Dashboard']);
})->name('admin');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
