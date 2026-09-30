<?php

use App\Http\Controllers\Backend\BasicSeoController;
use App\Http\Controllers\Backend\EntityController;
use App\Http\Controllers\Backend\GlobalSettingController;
use App\Http\Controllers\Backend\IslandReachSettingController;
use App\Http\Controllers\Backend\NewsCategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SiteMapController;
use App\Http\Controllers\Backend\SocialAnalyticController;
use App\Http\Controllers\Backend\SocialLinkController;
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

        Route::get('/island-reach-location', [IslandReachSettingController::class, 'index'])
            ->name('island-reach-location.index');

        Route::put('/island-reach-location/{islandReachSetting?}', [IslandReachSettingController::class, 'update'])
    ->name('island-reach-location.update');

        Route::get('/social-link', [SocialLinkController::class, 'index'])
            ->name('social-link.index');

        Route::put('/social-link/{socialLink?}', [SocialLinkController::class, 'update'])
            ->name('social-link.update');

        Route::get('/news-category', [NewsCategoryController::class, 'index'])
            ->name('news-category.index');
        Route::get('/entities/{entity}/image', [EntityController::class, 'image'])->name('entities.image');
        Route::patch('/entities/{entity}/active', [EntityController::class, 'toggleActive'])->name('entities.active');
        Route::resource('entities', EntityController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);
        Route::post('/news-category', [NewsCategoryController::class, 'store'])->name('news-category.store');
        Route::put('/news-category/{newsCategory}', [NewsCategoryController::class, 'update'])->name('news-category.update');
        Route::delete('/news-category/{newsCategory}', [NewsCategoryController::class, 'destroy'])->name('news-category.destroy');

        Route::get('/news', [NewsController::class, 'index'])
            ->name('news.index');
        Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::get('/news/{news}/image/{type}', [NewsController::class, 'image'])->name('news.image');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::post('/news/editor-images', [NewsController::class, 'uploadImage'])->name('news.editor-images.store');
        Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

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
