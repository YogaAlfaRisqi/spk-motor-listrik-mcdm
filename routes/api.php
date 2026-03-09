<?php

use App\Http\Controllers\API\CriteriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route for versioning
Route::get('/', function () {
        return response()->json([
            'message' => 'SPK API v1'
        ]);
});

// Route for dashboard
Route::get('/dashboard', function () {
        return response()->json(['message' => 'welcome to dashboard spk v1']);
});

// dashboard pages
Route::get('/admin', function () {
    return view('pages.dashboard.welcome-page', ['title' => 'Dashboard']);
})->name('admin');

// Route fro criteria
Route::apiResource('criteria',CriteriaController::class);
 
// // Route for weight
// Route::apiResource('weights', WeightController::class);

// // Route for alternative
// Route::apiResource('alternatives', AlternativeController::class);

// // Route for calculation
// Route::apiResource('calculations', CalculationController::class);

// // Route for weighted comparasion
// Route::apiResource('weighted-comparisons', WeightedComparisonController::class);

// // Route for ranking comparation
// Route::apiResource('ranking-comparisons', RankingComparisonController::class);

// Route for user
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');