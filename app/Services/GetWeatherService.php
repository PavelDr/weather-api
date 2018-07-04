<?php

namespace App\Services;

use GuzzleHttp\Client,
    GuzzleHttp\Promise,
    GuzzleHttp\Exception\ClientException;
use Log;

/**
 * Class GetWeatherService
 * @package App\Services
 */
class GetWeatherService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Weather api's
     * @var array
     */
    protected $apiClients;

    /**
     * GetWeatherService constructor.
     * @param Client $client
     * @param $apiClients
     */
    public function __construct(
        Client $client,
        $apiClients
    ) {
        $this->client = $client;
        $this->apiClients = $apiClients;
    }

    /**
     * Requests all possible api and merge collections
     * @return array
     */
    public function get():array
    {
        $promises = [];
        /** @var AbstractApiClient $apiClient */
        foreach($this->apiClients as $source => $apiClient) {
            $promises[$source] = $this->client->getAsync($apiClient->getUrl(), ['query' => $apiClient->getParams()]);
        }

        //Get results for all promises
        $results = Promise\settle($promises)->wait();

        $weatherData = [];
        foreach($results as $source => $result) {

            //Skip errors for some broken api
            if(!isset($result['value']) || (isset($result['reason']) && $result['reason'] instanceof ClientException)) {
                $response = json_decode($result['reason']->getResponse()->getBody()->getContents());
                Log::error('Api '.$source.' broken, because: '.print_r($response, true));

                continue;
            }

            $apiWeatherData = $this->apiClients[$source]->getWeatherData(json_decode($result['value']->getBody()->getContents()));
            $weatherData = array_merge_recursive($weatherData, $apiWeatherData);
        }

        return $weatherData;
    }
}