<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FileSaver;
use App\Generators;
use App\Services\GetWeatherService;
use GuzzleHttp\Client;
use App\Services;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GetWeatherService', function ($app){
            return new GetWeatherService(
                new Client(),
                [
                    Services\Weatherbit\ApiClient::SOURCE_NAME => $app->make('App\Services\Weatherbit\ApiClient'),
                    Services\Darksky\ApiClient::SOURCE_NAME => $app->make('App\Services\Darksky\ApiClient'),
                ]
            );
        });

        $this->app->bind('FileSaver', function ($app){
            return new FileSaver(
                [
                    Generators\JsonGenerator::GENERATOR_FORMAT => $app->make('App\Generators\JsonGenerator'),
                    Generators\XmlGenerator::GENERATOR_FORMAT => $app->make('App\Generators\XmlGenerator'),
                ]
            );
        });
    }
}
