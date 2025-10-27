<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowersController;
use App\Http\Controllers\MangaPanelsController;
use App\Http\Controllers\ProfilePageController;

// ---------- NAVIGATION ----------

Route::get('/', [MangaController::class, 'index'])->name('home');

Route::view('/contact', 'pages.contact');
Route::view('/communityPost', 'pages.communityPost');
Route::view('/addManga', 'addManga');


// ---------- AUTH ----------
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------- GOOGLE AUTH ----------
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ---------- MANGA ----------

Route::prefix('manga')->name('manga.')->group(function () {
    Route::get('/', [MangaController::class, 'index'])->name('index');
    Route::post('/', [MangaController::class, 'store'])->name('store');
    Route::get('/create', [MangaController::class, 'create'])->name('create');
    Route::get('/{id}', [MangaController::class, 'show'])->name('details');
    Route::delete('/{id}', [MangaController::class, 'remove'])->name('delete');

    // Chapters & Panels
    Route::post('/{id}/chapter', [ChapterController::class, 'uploadChapter'])->name('uploadChapter');
    Route::post('/chapter/{id}/upload-images', [MangaPanelsController::class, 'uploadImages'])->name('uploadImages');
    Route::get('/{id}/chapters', [ChapterController::class, 'showChapter'])->name('chapters');
    Route::get('/chapter/{id}', [MangaPanelsController::class, 'showMangaPanel'])->name('mangaPanel');
});

// ---------- COMMUNITY ----------
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::post('/community', [CommunityController::class, 'store'])->name('community.store');

// ---------- DASHBOARD ----------
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::put('/update', [AuthController::class, 'updateUsername'])->name('update');
});

// ---------- FAVORITES ----------
Route::middleware('auth')->group(function () {
    Route::post('/favorites', [FavoritesController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites', [FavoritesController::class, 'index'])->name('favorites.index');
});

// ---------- FOLLOWERS ----------
Route::post('/follow/toggle', [FollowersController::class, 'toggleFollow'])
    ->name('follow.toggle')
    ->middleware('auth');

// ---------- PROFILE ----------
Route::get('/profile/{id}', [ProfilePageController::class, 'showProfile'])->name('profile.show');

// ---------- GENRE ----------
Route::get('/fantastic', [MangaController::class, 'fantastic'])->name('genre.fantastic');
Route::get('/historic', [MangaController::class, 'historic'])->name('genre.historic');
