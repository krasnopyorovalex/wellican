<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Services\Search\Filters\Items\BetweenFilter;
use App\Domain\Services\Search\Filters\Items\PriceFromFilter;
use App\Domain\Services\Search\Filters\Items\PriceToFilter;
use App\Domain\Services\Search\Filters\Items\SquareFromFilter;
use App\Domain\Services\Search\Filters\Items\SquareToFilter;
use Domain\Contracts\Persistence\Search;
use Domain\Persistence\Storage\CommandHandler;
use Domain\Services\Search\Filters\Items\ArticulFilter;
use Domain\Services\Search\Filters\Items\IsPremiumFilter;
use Domain\Services\Search\Filters\Items\LocationIdFilter;
use Domain\Services\Search\Filters\Items\NameFilter;
use Domain\Services\Search\Filters\Items\OptionsFilter;
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
            $stackFilters->setFilter(new OptionsFilter());
            $stackFilters->setFilter(new PriceFromFilter());
            $stackFilters->setFilter(new PriceToFilter());
            $stackFilters->setFilter(new SquareFromFilter());
            $stackFilters->setFilter(new SquareToFilter());
            $stackFilters->setFilter(new ArticulFilter());
            $stackFilters->setFilter(new BetweenFilter());

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
