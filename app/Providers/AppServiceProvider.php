<?php

namespace App\Providers;

use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    }
}
