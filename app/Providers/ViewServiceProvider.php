<?php

declare(strict_types=1);

namespace App\Providers;

use App\View\Composers\LocationComposer;
use App\View\Composers\NewsComposer;
use App\View\Composers\ObjectTypeComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

final class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Facades\View::composer(['layouts.app', 'includes.forms.search', 'app.catalog.index', 'app.pages.index'], ObjectTypeComposer::class);
        Facades\View::composer(['includes.forms.search', 'app.pages.index'], LocationComposer::class);
        Facades\View::composer(['app.objects.index'], NewsComposer::class);
    }
}
