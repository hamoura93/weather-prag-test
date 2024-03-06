<?php

namespace App\Services;

use GuzzleHttp\Client; // Add the import statement for GuzzleHttp\Client

class WeatherService
{
    protected $apiKey;
    protected $client;

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key');
        $this->client = new Client([
            'base_uri' => 'http://api.openweathermap.org/data/2.5',
            
        ]);
    }

    public function getWeatherData($city)
    {
        try {
            $url = '/weather?q=' . $city . '&appid=' . $this->apiKey;
            \Log::info('OpenWeatherMap API URL: ' . $url);
    
            $response = $this->client->get($url);
    
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
