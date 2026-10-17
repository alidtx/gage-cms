<?php

namespace App\Providers;

use App\Services\FrontendSeo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        View::composer('frontend.layouts.app', function (\Illuminate\View\View $view): void {
            $view->with('seo', app(FrontendSeo::class)->resolve($view->getData()['pageSeo'] ?? []));
        });
    }
}
