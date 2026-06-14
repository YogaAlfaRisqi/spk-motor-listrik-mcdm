<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\DashboardController;
use App\Http\Controllers\Web\Admin\CriteriaController;
use App\Http\Controllers\Web\Admin\AlternativeController;
use App\Http\Controllers\Web\Admin\WeightController;
use App\Http\Controllers\Web\Admin\AlternativeValueController;
use App\Http\Controllers\Web\Admin\RecomendationResultController;
use App\Http\Controllers\Web\Admin\UserController;
use App\Livewire\AnalisisPage;
use App\Livewire\HomePage;
use App\Livewire\MotorPage;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/motor-overview', MotorPage::class)->name('motor-overview');
Route::get('/motor/compare', AnalisisPage::class)->name('analisis');

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
