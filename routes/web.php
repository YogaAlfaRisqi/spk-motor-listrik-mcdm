<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\CriteriaController;
use App\Http\Controllers\Web\Admin\AlternativeController;
use App\Http\Controllers\Web\Admin\WeightController;
use App\Http\Controllers\Web\Admin\AlternativeValueController;
use App\Http\Controllers\Web\Admin\RecomendationResultController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Http\Controllers\Web\Public\HomeController;

// User Routes
// Route::view('/', 'welcome');

// Route::get('/home', function () {
//     return 'Hello, World!';
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

// Admin Routes
Route::resource('dashboard', DashboardController::class);
Route::resource('criteria', CriteriaController::class);
Route::resource('alternatives', AlternativeController::class);
Route::resource('weight',WeightController::class);
Route::resource('alternative-values', AlternativeValueController::class);
Route::resource('recomendation-result', RecomendationResultController::class);
Route::resource('users', UserController::class);
// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
