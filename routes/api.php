<?php

use App\Http\Controllers\Api\AlternativeController;
use App\Http\Controllers\API\CriteriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route for versioning
Route::get('/', function () {
        return response()->json([
            'message' => 'SPK API v1'
        ]);
});

// Route fro criteria
Route::apiResource('criteria',CriteriaController::class);
 
// // Route for weight
// Route::apiResource('weights', WeightController::class);

// Route for alternative
Route::apiResource('alternative', AlternativeController::class);

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