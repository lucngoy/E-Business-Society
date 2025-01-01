<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NotificationController;

// Pages publiques
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/listings', [PageController::class, 'listings'])->name('listings');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/search', [BusinessController::class, 'search'])->name('business.search');


// routes pour les avis
Route::get('/business/{business}', [BusinessController::class, 'show'])->name('business.show');
Route::patch('/businesses/{business}/status', [BusinessController::class, 'changeStatus'])->name('businesses.changeStatus');
Route::post('/businesses/{business}/reviews', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy')->middleware('auth');
Route::get('/businesses/{business}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// Dashboard
Route::prefix('dashboard')->group(function () {
    Route::get('/overview', [DashboardController::class, 'overview'])->name('dashboard.overview');
    Route::get('/reviews', [ReviewController::class, 'reviews'])->name('dashboard.reviews');
    Route::get('/users', [UserController::class, 'index'])->name('dashboard.users');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('dashboard.reports');

    // Profile
    Route::get('/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::put('/settings/profile', [ProfileController::class, 'updateProfile'])->name('dashboard.settings.updateProfile');
    Route::put('/settings/password', [ProfileController::class, 'updatePassword'])->name('dashboard.settings.updatePassword');

})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour la gestion des entreprises
Route::prefix('dashboard/businesses')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [BusinessController::class, 'index'])->name('businesses.index');
    Route::get('/create', [BusinessController::class, 'create'])->name('businesses.create');
    Route::post('/', [BusinessController::class, 'store'])->name('businesses.store');
    Route::get('/{business}/edit', [BusinessController::class, 'edit'])->name('businesses.edit');
    Route::put('/{business}', [BusinessController::class, 'update'])->name('businesses.update');
    Route::delete('/{business}', [BusinessController::class, 'destroy'])->name('businesses.destroy');
});

// Routes pour la gestion de notification
Route::prefix('dashboard/notifications')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('/notification/{notification}', [NotificationController::class, 'show'])->name('notifications.show');
    Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

});

// Routes pour la gestion des entreprises
Route::prefix('dashboard/categories')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

// Routes pour la gestion du profil utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{user}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour la gestion des entreprises (Business Profile Management)
Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('businesses', BusinessController::class);
});

// Route pour les erreurs d'accès non autorisé
Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized')->middleware('auth');

// Auth routes
require __DIR__.'/auth.php';
