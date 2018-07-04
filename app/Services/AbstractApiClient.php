<?php

namespace App\Services;

/**
 * Class AbstractApiClient
 * @package App\Services
 */
abstract class AbstractApiClient
{
    /**
     * @var string
     */
    protected $endpoint;

    /**
     * Additional params
     * @var array
     */
    protected $params = [];

    /**
     * AbstractApiClient constructor.
     * @param null $lat
     * @param null $lon
     */
    public function __construct(
        $lat = null,
        $lon = null
    ) {
    }

    /**
     * Get weathers
     * @return array
     */
    abstract public function getWeatherData($guzzleBody):array;

    /**\
     * @return string
     */
    public function getUrl()
    {
        return $this->endpoint;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}