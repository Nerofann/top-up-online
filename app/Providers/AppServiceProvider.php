<?php

namespace App\Providers;

use App\Services\Sidebar;
use App\Services\SidebarImplement;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Sidebar::class, SidebarImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $sidebar = $this->app->make(Sidebar::class);
    }
}
