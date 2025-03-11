<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherController extends Controller
{
    private $apiKey;
    private $baseUrl;
    private const CACHE_DURATION = 1800;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.key');
        $this->baseUrl = config('services.openweather.url');
        
        if (!$this->apiKey) {
            throw new \RuntimeException('key not found');
        }
    }

    public function getWeather($city)
    {
        return Cache::remember(
            'weather_' . strtolower($city), 
            self::CACHE_DURATION, 
            fn() => $this->fetchWeatherData($city)
        );
    }

    private function fetchWeatherData($city)
    {
        try {
            $response = Http::get($this->baseUrl, [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]);

            return $response->successful() 
                ? $response->json()
                : ['error' => 'city not found', 'status' => 404];

        } catch (\Exception $e) {
            return ['error' => 'error', 'status' => 500];
        }
    }
}