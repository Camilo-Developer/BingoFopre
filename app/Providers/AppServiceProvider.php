<?php

namespace App\Providers;

use App\Models\CartonGroup\CartonGroup;
use App\Models\TemplateConfig\TemplateConfig;
use Illuminate\Support\Facades\Auth;
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
            $userId = null;

            if (Auth::check()) {
                $userId = Auth::user()->id;
            }

            //dd($userId);
            $currentYear = date('Y');

            $card_groups_shows = CartonGroup::where('user_id', $userId)
                ->whereYear('created_at', $currentYear)
                ->withCount([
                    'cardboard',
                    'cardboard as cardboards_vendidos' => function ($query) {
                        $query->where('state_id', 5);
                    },
                    'cardboard as cardboards_obsequio' => function ($query) {
                        $query->where('state_id', 6);
                    },
                ])
                ->with(['cardboard' => function ($query) {
                    $query->select('id', 'name', 'state_id', 'group_id');
                }])
                ->get();

            $card_groups = CartonGroup::where('user_id', $userId)
                ->where('state_id', 3)
                ->withCount([
                    'cardboard',
                    'cardboard as cardboards_vendidos' => function ($query) {
                        $query->where('state_id', 5);
                    },
                    'cardboard as cardboards_obsequio' => function ($query) {
                        $query->where('state_id', 6);
                    },
                ])
                ->with(['cardboard' => function ($query) {
                    $query->select('id', 'name', 'state_id', 'group_id');
                }])
                ->paginate(5);

            $view->with('templateconfigs', $templateconfigs);
            $view->with('card_groups_shows', $card_groups_shows);
            $view->with('card_groups', $card_groups);


        });
        View::composer('layouts.app2',function ($view) {
            $templateconfigs = TemplateConfig::all();
            $view->with('templateconfigs', $templateconfigs);
        });
        View::composer('auth.login',function ($view) {
            $templateconfigs = TemplateConfig::all();
            $view->with('templateconfigs', $templateconfigs);
        });
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

    }
}
