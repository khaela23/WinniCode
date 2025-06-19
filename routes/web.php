<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');


Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/author/{username}', [AuthorController::class, 'show'])->name('author.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/kategori/{slug}', [NewsController::class, 'category'])->name('news.category');

Route::middleware('IsAdmin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class);
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class);
    Route::resource('banners', App\Http\Controllers\Admin\BannerController::class);
    Route::resource('news-categories', App\Http\Controllers\Admin\NewsCategoryController::class);
    // Nanti tambahkan resource lain di sini (news, banners, news-categories)
});
