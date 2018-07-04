<?php

namespace App\Domain\Factories;

use App\Domain\Dto\WeatherDto;

/**
 * Class WeatherFactory
 * @package App\Domain\Factories
 */
class WeatherFactory
{
    /**
     * @param $temperature
     * @param $minTemperature
     * @param $maxTemperature
     * @param $source
     * @return WeatherDto
     */
    public static function createWeather(
        $temperature,
        $minTemperature,
        $maxTemperature,
        $source
    ):WeatherDto
    {
        $weather = new WeatherDto(
            $temperature,
            $minTemperature,
            $maxTemperature,
            $source
        );

        return $weather;
    }
}