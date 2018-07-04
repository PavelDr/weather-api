<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\FileSaver;
use App\Services\GetWeatherService;

/**
 * Class SaveWeatherFile
 * @package App\Jobs
 */
class SaveWeatherFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /** @var FileSaver $fileSaver */
        $fileSaver = \App::make('FileSaver');
        /** @var GetWeatherService $getWeatherService */
        $getWeatherService = \App::make('GetWeatherService');

        $weatherData = $getWeatherService->get();

        $fileName = $fileSaver->saveData($weatherData);
    }
}
