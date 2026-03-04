<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
        return response()->json(['message' => 'hello world']);
    });

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
