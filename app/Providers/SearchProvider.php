<?php

declare(strict_types=1);

namespace App\Providers;

use Domain\Contracts\Persistence\Search;
use Domain\Persistence\Storage\CommandHandler;
use Domain\Services\Search\Filters\Items\FilterOptionsFilter;
use Domain\Services\Search\Filters\Items\IsPremiumFilter;
use Domain\Services\Search\Filters\Items\LocationIdFilter;
use Domain\Services\Search\Filters\Items\NameFilter;
use Domain\Services\Search\Filters\Items\TypeIdFilter;
use Domain\Services\Search\Filters\Items\TypePurchaseFilter;
use Domain\Services\Search\Filters\StackFilters;
use Domain\Services\Search\MySqlSearch;
use Illuminate\Support\ServiceProvider;

final class SearchProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(Search::class, function () {
            $stackFilters = new StackFilters();
            $stackFilters->setFilter(new NameFilter());
            $stackFilters->setFilter(new TypeIdFilter());
            $stackFilters->setFilter(new LocationIdFilter());
            $stackFilters->setFilter(new TypePurchaseFilter());
            $stackFilters->setFilter(new IsPremiumFilter());
            $stackFilters->setFilter(new FilterOptionsFilter());

            return new MySqlSearch(new CommandHandler(), $stackFilters);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
