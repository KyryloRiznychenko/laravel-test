<?php

namespace App\Providers;

use App\Repositories\CsvDestinationRepository;
use App\Repositories\DestinationRepositoryInterface;
use App\Services\DestinationService;
use Illuminate\Support\ServiceProvider;

class DestinationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(DestinationRepositoryInterface::class, fn($app) => new CsvDestinationRepository(
            base_path('database/destinations.csv')
        ));

        $this->app->bind(DestinationService::class, fn($app) => new DestinationService(
            app(DestinationRepositoryInterface::class),
            config('destination.earth_radius'),
        ));
    }
}
