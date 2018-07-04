<?php

namespace App\Services\Weatherbit;

use App\Services\AbstractApiClient;
use App\Domain\Factories\WeatherFactory;

/**
 * Class ApiClient
 * @package App\Services\Weatherbit
 */
class ApiClient extends AbstractApiClient
{
    const SOURCE_NAME = 'Weatherbit';

    protected $endpoint = 'https://api.weatherbit.io/v2.0/forecast/daily?';

    /**
     * ApiClient constructor.
     * @param null $lat
     * @param null $lon
     */
    public function __construct(
        $lat = null,
        $lon = null
    ) {
        $this->params = config('weather.weatherbit.params');
        $this->params['key'] = config('weather.weatherbit.apiKey');

        //Default params
        $this->params['lang'] = config('weather.params.lang');
        $this->params['lat'] = $lat ?? config('weather.params.lat');
        $this->params['lon'] = $lon ?? config('weather.params.lon');
    }

    /**
     * Get weathers
     * @param $guzzleBody
     * @return array
     */
    public function getWeatherData($guzzleBody):array
    {
        $weathers = $guzzleBody->data;

        $weatherData = [];
        foreach($weathers as $weather) {
            $weatherDto = WeatherFactory::createWeather(
                $weather->temp,
                $weather->min_temp,
                $weather->max_temp,
                self::SOURCE_NAME
            );
            $weatherData[$weather->valid_date][] = $weatherDto;
        }

        return $weatherData;
    }
}