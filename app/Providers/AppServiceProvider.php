<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Throwable;

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

     public function menus() {
        // Cache::forget('AdminPanelMenus');

        return Menu::query()
                ->with('submenu')
                ->orderBy('title')
                ->get();
    }

    public function boot(): void
    {
        //
        Blade::component('app-layout', \App\View\Components\AppLayout::class);

        if($this->app->environment('production'))
        {
            URL::forceScheme('https');
        }

        // Using view composer for authenticated user-specific logic
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with('menus', $this->menus());
            }
        });

        // Share global settings without blocking artisan diagnostics when the DB is unavailable.
        try {
            View::share('settings', Cache::rememberForever('GlobalSettings', function () {
                return Setting::pluck('value', 'key');
            }));
        } catch (Throwable $exception) {
            View::share('settings', collect());
        }

    }
}
