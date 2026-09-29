<?php

use App\Http\Controllers\Backend\BasicSeoController;
use App\Http\Controllers\Backend\GlobalSettingController;
use App\Http\Controllers\Backend\SiteMapController;
use App\Http\Controllers\Backend\ProfileController;
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
Route::get('/sitemap.xml', [SiteMapController::class, 'xml'])->name('sitemap.xml');

Route::middleware('auth')
    ->prefix('backend')
    ->name('backend.')
    ->group(function () {

        Route::get('/sitemap', [SiteMapController::class, 'index'])->name('sitemap.index');
        Route::put('/sitemap', [SiteMapController::class, 'update'])->name('sitemap.update');
        Route::post('/sitemap/regenerate', [SiteMapController::class, 'regenerate'])->name('sitemap.regenerate');

        Route::get('/basic-seo', [BasicSeoController::class, 'index'])
            ->name('basic-seo.index');

        Route::put('/basic-seo/{basicSeo}', [BasicSeoController::class, 'update'])
            ->name('basic-seo.update');

        Route::get('/basic-seo/{basicSeo}/image', [BasicSeoController::class, 'image'])
            ->name('basic-seo.image');

        Route::get('global-settings', [GlobalSettingController::class, 'index'])
            ->name('global-settings.index');

        Route::get('global-settings/{globalSetting}/image/{type}', [GlobalSettingController::class, 'image'])
            ->name('global-settings.image');

        Route::put('global-settings/{globalSetting}', [GlobalSettingController::class, 'update'])
            ->name('global-settings.update');

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
