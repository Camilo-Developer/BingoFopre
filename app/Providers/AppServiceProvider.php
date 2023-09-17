<?php

namespace App\Providers;

use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        View::composer('layouts.guest',function ($view) {
            $templateconfigs = TemplateConfig::all();
            $view->with('templateconfigs', $templateconfigs);
        });
        View::composer('layouts.app2',function ($view) {
            $templateconfigs = TemplateConfig::all();
            $view->with('templateconfigs', $templateconfigs);
        });
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

    }
}
