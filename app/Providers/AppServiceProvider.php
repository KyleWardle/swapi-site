<?php

namespace App\Providers;

use App\Http\Services\StarWarsAPI\StarWarsAPIClient;
use App\Http\Services\StarWarsAPI\StarWarsAPIService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        StarWarsAPIService::class => StarWarsAPIService::class,
        StarWarsAPIClient::class => StarWarsAPIClient::class
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
