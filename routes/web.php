<?php

use App\Http\Controllers\Backend\BasicSeoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Backend routes
Route::middleware('auth')
    ->prefix('backend')
    ->name('backend.')
    ->group(function () {

        Route::get('/basic-seo', [BasicSeoController::class, 'index'])
            ->name('basic-seo.index');

        Route::put('/basic-seo/{basicSeo}', [BasicSeoController::class, 'update'])
            ->name('basic-seo.update');

        Route::get('/basic-seo/{basicSeo}/image', [BasicSeoController::class, 'image'])
            ->name('basic-seo.image');

        Route::get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');

        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');

        Route::delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    });

// Frontend routes
Route::prefix('frontend')
    ->name('frontend.')
    ->group(function () {

        Route::get('/', function () {
            return view('frontend.home');
        })->name('home');

        // Other frontend routes...
    });

require __DIR__.'/auth.php';
