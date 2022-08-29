<?php

namespace App\Providers;

use App\Services\Contracts\PeopleServiceInterface;
use App\Services\Contracts\PlanetServiceInterface;
use App\Services\Contracts\SpeciesServiceInterface;
use App\Services\PeopleService;
use App\Services\PlanetService;
use App\Services\SpeciesService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PeopleServiceInterface::class, PeopleService::class);
        $this->app->bind(PlanetServiceInterface::class, PlanetService::class);
        $this->app->bind(SpeciesServiceInterface::class, SpeciesService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
