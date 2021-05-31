<?php

namespace App\Providers;

use App\Http\Services\ImageSearch\Client\ImageSearchClientInterface;
use App\Http\Services\ImageSearch\Client\RapidApiWebSearch\Client;
use App\Http\Services\ImageSearch\ImageSearchService;
use App\Http\Services\StarWarsApi\StarWarsService;
use App\Http\Services\StarWarsApi\Swapi\SwapiApiClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        StarWarsService::class => StarWarsService::class,
        SwapiApiClient::class => SwapiApiClient::class,
        ImageSearchClientInterface::class => Client::class,
        ImageSearchService::class => ImageSearchService::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
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
