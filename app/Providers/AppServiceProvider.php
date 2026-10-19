<?php

namespace App\Providers;

use App\Services\FrontendSeo;
use App\Services\FrontendSocialLinks;
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
        $this->app->scoped(FrontendSocialLinks::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
        View::composer(['frontend.layouts.app', 'frontend.pages.*'], function (\Illuminate\View\View $view): void {
            $view->with('socialLinks', app(FrontendSocialLinks::class)->all());
        });
        View::composer('frontend.layouts.app', function (\Illuminate\View\View $view): void {
            $view->with('seo', app(FrontendSeo::class)->resolve($view->getData()['pageSeo'] ?? []));
        });
    }
}
