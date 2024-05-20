<?php

namespace App\Providers;

use App\Services\ApiGames;
use App\Services\ApiGamesImplement;
use App\Services\ApiTokoVoucher;
use App\Services\ApiTokoVoucherImplement;
use App\Services\AppGlobals;
use App\Services\AppGlobalsImplement;
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
        $this->app->singleton(AppGlobals::class, AppGlobalsImplement::class);
        $this->app->singleton(ApiTokoVoucher::class, ApiTokoVoucherImplement::class);
        // $this->app->singleton(ApiGames::class, ApiGamesImplement::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->make(AppGlobals::class);
        $this->app->make(ApiTokoVoucher::class);
        // $this->app->make(ApiGames::class);
    }
}
