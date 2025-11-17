<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your mobile application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group.
|
*/

// Public API Routes (No Authentication Required)
Route::prefix('v1')->group(function () {
    
    // Gallery Endpoints
    Route::get('/galleries', [GalleryController::class, 'index']);
    Route::get('/galleries/{id}', [GalleryController::class, 'show']);
    Route::get('/galleries/category/{categoryId}', [GalleryController::class, 'byCategory']);
    Route::get('/categories', [GalleryController::class, 'categories']);
    
    // News Endpoints
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{slug}', [NewsController::class, 'show']);
    Route::get('/news/category/{category}', [NewsController::class, 'byCategory']);
    
    // Agenda Endpoints
    Route::get('/agendas', [NewsController::class, 'agendas']);
});

// Test endpoint
Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API is working!',
        'version' => '1.0.0'
    ]);
});
