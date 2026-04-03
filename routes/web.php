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


// public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
// Route::get('/', function () {
//     return view('pages.home');
// })->name('home');
 
Route::get('/cara-kerja', function () {
    return view('pages.how-it-works');
})->name('how-it-works');
 
Route::get('/tentang', function () {
    return view('pages.about');
})->name('about');
 
Route::get('/rekomendasi', function () {
    return view('pages.recommendation');
})->name('recommendation');

// Admin Routes
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('criteria', CriteriaController::class);
        Route::resource('alternatives', AlternativeController::class);
        Route::resource('weight', WeightController::class);
        Route::resource('alternative-values', AlternativeValueController::class);
        Route::resource('recommendation-results', RecomendationResultController::class);
        Route::resource('users', UserController::class);
        Route::view('profile', 'profile')
            ->name('profile');
    });



require __DIR__ . '/auth.php';
