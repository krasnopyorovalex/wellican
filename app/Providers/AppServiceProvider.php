<?php

namespace App\Providers;

use Domain\Contracts\Image\Resizer;
use Domain\Contracts\Image\Uploader;
use Domain\Contracts\Persistence\Handler;
use Domain\Contracts\Persistence\Storage;
use Domain\Persistence\Storage\CommandHandler;
use Domain\Persistence\Storage\DatabaseStorage;
use Domain\Services\ImageResizer\InterventionResizer;
use Domain\Services\ImageUploader\DiskUploader;
use Illuminate\Database\Connection;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;

//use Illuminate\Database\Eloquent\Model;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Handler::class, CommandHandler::class);

        $this->app->singleton(Storage::class, DatabaseStorage::class);

        $this->app->singleton(Uploader::class, DiskUploader::class);

        $this->app->singleton(
            Resizer::class,
            fn () => new InterventionResizer(new ImageManager(new Driver()))
        );

        //Model::preventLazyLoading(!app()->isProduction());
        //Model::preventsSilentlyDiscardingAttributes();

        DB::whenQueryingForLongerThan(config('when_querying_for_longer_than'), function (Connection $connection, QueryExecuted $event) {
            //TODO notify to telegram
        });
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
