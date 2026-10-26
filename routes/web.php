<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMusicController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SOUND Group Entertainment Portal
|--------------------------------------------------------------------------
*/

// Public Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

// Music Catalog & Detail
Route::get('/music', [MusicController::class, 'index'])->name('music.index');
Route::get('/music/{id}', [MusicController::class, 'show'])->name('music.show');

// Video Catalog & Detail
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');

// Category Browsing (Album, Artist, Year, Genre, Language)
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/artists', [CategoryController::class, 'artists'])->name('artists');
    Route::get('/artists/{id}', [CategoryController::class, 'showArtist'])->name('artists.show');

    Route::get('/albums', [CategoryController::class, 'albums'])->name('albums');
    Route::get('/albums/{id}', [CategoryController::class, 'showAlbum'])->name('albums.show');

    Route::get('/genres', [CategoryController::class, 'genres'])->name('genres');
    Route::get('/genres/{id}', [CategoryController::class, 'showGenre'])->name('genres.show');

    Route::get('/years', [CategoryController::class, 'years'])->name('years');
    Route::get('/years/{year}', [CategoryController::class, 'showYear'])->name('years.show');

    Route::get('/languages', [CategoryController::class, 'languages'])->name('languages');
    Route::get('/languages/{id}', [CategoryController::class, 'showLanguage'])->name('languages.show');
});

// Direct Shortcuts for Top Menu
Route::get('/artists', [CategoryController::class, 'artists'])->name('artists');
Route::get('/albums', [CategoryController::class, 'albums'])->name('albums');
Route::get('/genres', [CategoryController::class, 'genres'])->name('genres');
Route::get('/years', [CategoryController::class, 'years'])->name('years');
Route::get('/languages', [CategoryController::class, 'languages'])->name('languages');

// Global Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    // Add / Modify Reviews & Ratings
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Administrator Panel Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Music Management
    Route::resource('music', AdminMusicController::class)->except(['show']);
    Route::post('/music/{id}/toggle-new', [AdminMusicController::class, 'toggleNew'])->name('music.toggle-new');

    // Video Management
    Route::resource('videos', AdminVideoController::class)->except(['show']);
    Route::post('/videos/{id}/toggle-new', [AdminVideoController::class, 'toggleNew'])->name('videos.toggle-new');

    // Category Management (Year, Artist, Album, Genre, Language)
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/artists', [AdminCategoryController::class, 'storeArtist'])->name('categories.artists.store');
    Route::delete('/categories/artists/{id}', [AdminCategoryController::class, 'deleteArtist'])->name('categories.artists.destroy');
    Route::post('/categories/albums', [AdminCategoryController::class, 'storeAlbum'])->name('categories.albums.store');
    Route::delete('/categories/albums/{id}', [AdminCategoryController::class, 'deleteAlbum'])->name('categories.albums.destroy');
    Route::post('/categories/genres', [AdminCategoryController::class, 'storeGenre'])->name('categories.genres.store');
    Route::delete('/categories/genres/{id}', [AdminCategoryController::class, 'deleteGenre'])->name('categories.genres.destroy');
    Route::post('/categories/years', [AdminCategoryController::class, 'storeYear'])->name('categories.years.store');
    Route::delete('/categories/years/{id}', [AdminCategoryController::class, 'deleteYear'])->name('categories.years.destroy');
    Route::post('/categories/languages', [AdminCategoryController::class, 'storeLanguage'])->name('categories.languages.store');
    Route::delete('/categories/languages/{id}', [AdminCategoryController::class, 'deleteLanguage'])->name('categories.languages.destroy');

    // User Management
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::post('/users/{id}/toggle-active', [AdminUserController::class, 'toggleActive'])->name('users.toggle-active');

    // Website Information / Details Management
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::post('/settings/export-backup', [AdminSettingController::class, 'exportBackup'])->name('settings.export-backup');
    Route::get('/settings/download-backup', [AdminSettingController::class, 'downloadBackup'])->name('settings.download-backup');
});
