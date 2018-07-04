<?php

namespace App\Http\Controllers;

use App\Jobs\SaveWeatherFile as SaveWeatherFileJob;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController extends Controller
{
    /**
     * @return string
     */
    public function getWeather()
    {
        //Dispatch job for save file
        $this->dispatch(new SaveWeatherFileJob());

        return 'File will be create, check storage folder';
    }
}
