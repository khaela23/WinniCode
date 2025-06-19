<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AuthorApiController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\BannerApiController;
use App\Http\Controllers\Api\NewsCategoryApiController;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('news', [NewsApiController::class, 'index']);
Route::get('news/{id}', [NewsApiController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('news', [NewsApiController::class, 'store']);
    Route::put('news/{id}', [NewsApiController::class, 'update']);
    Route::delete('news/{id}', [NewsApiController::class, 'destroy']);
});

Route::get('banners', [BannerApiController::class, 'index']);
Route::get('banners/{id}', [BannerApiController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('banners', [BannerApiController::class, 'store']);
    Route::put('banners/{id}', [BannerApiController::class, 'update']);
    Route::delete('banners/{id}', [BannerApiController::class, 'destroy']);
});

Route::get('news-categories', [NewsCategoryApiController::class, 'index']);
Route::get('news-categories/{id}', [NewsCategoryApiController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('news-categories', [NewsCategoryApiController::class, 'store']);
    Route::put('news-categories/{id}', [NewsCategoryApiController::class, 'update']);
    Route::delete('news-categories/{id}', [NewsCategoryApiController::class, 'destroy']);
});

Route::get('authors', [AuthorApiController::class, 'index']);
Route::get('authors/{id}', [AuthorApiController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('authors', [AuthorApiController::class, 'store']);
    Route::put('authors/{id}', [AuthorApiController::class, 'update']);
    Route::delete('authors/{id}', [AuthorApiController::class, 'destroy']);
});
