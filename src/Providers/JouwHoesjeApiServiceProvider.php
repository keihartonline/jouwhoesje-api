<?php

namespace KeihartOnline\JouwHoesjeApi\Providers;

use Illuminate\Support\ServiceProvider;
use KeihartOnline\JouwHoesjeApi\ApiClient;
use KeihartOnline\JouwHoesjeApi\Contracts\TokenResolverInterface;

class JouwHoesjeApiServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Config publishable maken
        $this->mergeConfigFrom(__DIR__ . '/../../config/jouwhoesje-api.php', 'jouwhoesje-api');

        $this->app->singleton(ApiClient::class, function ($app) {
            return new ApiClient($app->make(TokenResolverInterface::class));
        });
    }

    public function boot()
    {
        //
    }
}