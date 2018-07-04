<?php

namespace App\Generators;

use App\Domain\Dto\WeatherDto;

/**
 * Class XmlGenerator
 * @package App\Generators
 */
class XmlGenerator extends AbstractGenerator
{
    const GENERATOR_FORMAT = 'xml';

    /**
     * Prefix for file name
     * @var string
     */
    protected $fileName = 'Xml';

    /**
     * Generate data for save in file
     * @param array $data
     * @return mixed
     */
    public function generateData(array $data)
    {
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><dates></dates>");

        foreach($data as $date => $weathers) {

            $dateXml = $xml->addChild('date', $date);

            /** @var WeatherDto $weatherDto */
            foreach($weathers as $weatherDto) {
                $weather = $dateXml->addChild('weather');
                $weather->addChild('temperature', $weatherDto->getTemperature());
                $weather->addChild('minTemperature', $weatherDto->getMinTemperature());
                $weather->addChild('maxTemperature', $weatherDto->getMaxTemperature());
                $weather->addChild('source', $weatherDto->getSource());
            }
        }

        return $xml->asXML();
    }
}