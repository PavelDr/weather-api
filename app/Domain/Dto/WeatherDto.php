<?php

namespace App\Domain\Dto;

/**
 * Class WeatherDto
 * @package App\Domain\Dto
 */
class WeatherDto
{
    private $temperature;

    private $minTemperature;

    private $maxTemperature;

    private $source;

    public function __construct(
        $temperature,
        $minTemperature,
        $maxTemperature,
        $source
    ) {
        $this->temperature = $temperature;
        $this->minTemperature = $minTemperature;
        $this->maxTemperature = $maxTemperature;
        $this->source = $source;
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return mixed
     */
    public function getMinTemperature()
    {
        return $this->minTemperature;
    }

    /**
     * @return mixed
     */
    public function getMaxTemperature()
    {
        return $this->maxTemperature;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }
}