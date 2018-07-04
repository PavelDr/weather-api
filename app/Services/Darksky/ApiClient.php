<?php

namespace App\Services\Darksky;

use App\Services\AbstractApiClient;
use App\Domain\Factories\WeatherFactory;

/**
 * Class ApiClient
 * @package App\Services\Darksky
 */
class ApiClient extends AbstractApiClient
{
    const SOURCE_NAME = 'Darksky';

    protected $endpoint = 'https://api.darksky.net/forecast/';

    /**
     * ApiClient constructor.
     * @param null $lat
     * @param null $lon
     */
    public function __construct(
        $lat = null,
        $lon = null
    ) {
        //Default params
        $lat = $lat ?? config('weather.params.lat');
        $lon = $lon ?? config('weather.params.lon');

        $this->endpoint.= config('weather.darksky.apiKey') . '/' . $lat . ',' . $lon;

        $this->params = config('weather.darksky.params');
        $this->params['lang'] = config('weather.params.lang');
    }

    /**
     * Get weathers
     * @param $guzzleBody
     * @return array
     */
    public function getWeatherData($guzzleBody):array
    {
        $weathers = $guzzleBody->daily->data;

        $weatherData = [];
        foreach($weathers as $weather) {
            $weatherDto = WeatherFactory::createWeather(
                $this->calculateTemperature($weather->temperatureMin, $weather->temperatureMax),
                $weather->temperatureMin,
                $weather->temperatureMax,
                self::SOURCE_NAME
            );
            $weatherData[date('Y-m-d', $weather->time)][] = $weatherDto;
        }

        return $weatherData;
    }

    /**
     * Calculate temperature
     * @param $temperatureMin
     * @param $temperatureMax
     * @return mixed
     */
    protected function calculateTemperature($temperatureMin, $temperatureMax)
    {
        return $temperatureMin + ($temperatureMax - $temperatureMin) / 2;
    }
}