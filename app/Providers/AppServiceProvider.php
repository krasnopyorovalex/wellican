<?php

namespace App\Providers;

use Domain\Contracts\Persistence\Handler;
use Domain\Persistence\CommandHandler;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Handler::class, CommandHandler::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Blade::include('includes.input', 'input');
        Blade::include('includes.select', 'select');
    }
}
