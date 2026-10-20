<?php

use App\Http\Controllers\Backend\BasicSeoController;
use App\Http\Controllers\Backend\ContactSubmissionController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DivisionController;
use App\Http\Controllers\Backend\EntityController;
use App\Http\Controllers\Backend\GlobalSettingController;
use App\Http\Controllers\Backend\IslandReachSettingController;
use App\Http\Controllers\Backend\NewsCategoryController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\PageContentController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\ProgrammeGroupController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SiteMapController;
use App\Http\Controllers\Backend\SocialLinkController;
use App\Http\Controllers\Backend\TrainingEnquiryController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\Frontend\EntityImageController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PageHeroImageController;
use App\Http\Controllers\Frontend\ProgrammeController;
use App\Http\Controllers\Frontend\SeoImageController;
use App\Http\Controllers\Frontend\ServiceIconController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/training/programmes', [ProgrammeController::class, 'index'])->name('frontend.programmes.index');
Route::get('/training/divisions/{division:slug}', [ProgrammeController::class, 'show'])->name('frontend.programmes.show');
Route::post('/training/divisions/{division:slug}/enquiry', [ProgrammeController::class, 'enquire'])->middleware('throttle:5,1')->name('frontend.programmes.enquire');

Route::get('/about', [FrontendController::class, 'about'])->name('frontend.about');
Route::get('/news', [App\Http\Controllers\Frontend\NewsController::class, 'index'])->name('frontend.news');
Route::get('/news/{slug}/image/{type}', [App\Http\Controllers\Frontend\NewsController::class, 'image'])->name('frontend.news.image');
Route::get('/news/{slug}', [App\Http\Controllers\Frontend\NewsController::class, 'show'])->name('frontend.news.show');
Route::get('/gage-security', [FrontendController::class, 'gageSecurity'])->name('frontend.gage-security');
Route::get('/gage-fire-safety', [FrontendController::class, 'gageFireSafety'])->name('frontend.gage-fire-safety');
Route::get('/gage-training-instruction', [FrontendController::class, 'gageTrainingInstruction'])->name('frontend.gage-training-instruction');
Route::get('/gage-technology', [FrontendController::class, 'gageTechnology'])->name('frontend.gage-technology');
Route::get('/gage-project-client', [FrontendController::class, 'gageProjectClient'])->name('frontend.gage-project-client');
Route::get('/service-icons/{service}', ServiceIconController::class)->name('frontend.service-icon');
Route::get('/entity-images/{entity}', EntityImageController::class)->name('frontend.entity-image');
Route::get('/page-hero-images/{pageContent}', PageHeroImageController::class)->name('frontend.page-hero-image');
Route::get('/seo-images/{media}', SeoImageController::class)->name('frontend.seo-image');
Route::get('/solutions', [FrontendController::class, 'solution'])->name('frontend.solutions');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/contact', [ContactFormController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactFormController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

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

        Route::post('/island-reach-location', [IslandReachSettingController::class, 'store'])
            ->name('island-reach-location.store');

        Route::put('/island-reach-location/{islandReachSetting}', [IslandReachSettingController::class, 'update'])
            ->name('island-reach-location.update');

        Route::delete('/island-reach-location/{islandReachSetting}', [IslandReachSettingController::class, 'destroy'])
            ->name('island-reach-location.destroy');

        Route::get('/social-link', [SocialLinkController::class, 'index'])
            ->name('social-link.index');

        Route::put('/social-link/{socialLink?}', [SocialLinkController::class, 'update'])
            ->name('social-link.update');

        Route::get('/news-category', [NewsCategoryController::class, 'index'])
            ->name('news-category.index');
        Route::get('/entities/{entity}/image', [EntityController::class, 'image'])->name('entities.image');
        Route::resource('entities', EntityController::class)->only(['index', 'edit', 'store', 'update', 'destroy']);
        Route::get('/services/{service}/image', [ServiceController::class, 'image'])->name('services.image');
        Route::resource('services', ServiceController::class)->only(['index', 'store', 'update', 'destroy']);
        Route::resource('programs', ProgramController::class)->parameters(['programs' => 'program'])->only(['index', 'store', 'update', 'destroy']);
        Route::resource('divisions', DivisionController::class)->parameters(['divisions' => 'division'])->only(['index', 'store', 'update', 'destroy']);
        Route::resource('programme-groups', ProgrammeGroupController::class)->parameters(['programme-groups' => 'programmeGroup'])->only(['index', 'store', 'update', 'destroy']);
        Route::resource('training-enquiries', TrainingEnquiryController::class)->parameters(['training-enquiries' => 'trainingEnquiry'])->only(['index', 'update', 'destroy']);
        Route::resource('contact-submissions', ContactSubmissionController::class)->parameters(['contact-submissions' => 'contactSubmission'])->only(['index', 'show', 'destroy']);
        Route::get('/pages/{pageContent}/image', [PageContentController::class, 'image'])->name('pages.image');
        Route::patch('/pages/{pageContent}/active', [PageContentController::class, 'toggleActive'])->name('pages.active');
        Route::resource('pages', PageContentController::class)->parameters(['pages' => 'pageContent'])->only(['index', 'edit', 'store', 'update', 'destroy']);
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
Route::permanentRedirect('/frontend', '/');

require __DIR__.'/auth.php';
