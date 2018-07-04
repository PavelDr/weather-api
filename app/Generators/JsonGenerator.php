<?php

namespace App\Generators;

use App\Domain\Dto\WeatherDto;

/**
 * Class JsonGenerator
 * @package App\Generators
 */
class JsonGenerator extends AbstractGenerator
{
    const GENERATOR_FORMAT = 'json';

    /**
     * Prefix for file name
     * @var string
     */
    protected $fileName = 'Json';
    
    /**
     * Generate data for save in file
     * @param array $data
     * @return string
     */
    public function generateData(array $data)
    {
        $parsedCollection['dates'] = [];
        foreach($data as $date => $weathers) {
            /** @var WeatherDto $weatherDto */
            foreach($weathers as $weatherDto) {
                $weather = [
                    'weather' => [
                        'temperature' => $weatherDto->getTemperature(),
                        'minTemperature' => $weatherDto->getMinTemperature(),
                        'maxTemperature' => $weatherDto->getMaxTemperature(),
                        'source' => $weatherDto->getSource(),
                    ]
                ];

                $parsedCollection['dates'][$date][] = $weather;
            }
        }

        return json_encode($parsedCollection);
    }
}