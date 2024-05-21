<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeatherApiController extends Controller
{
    // Get weather data from WeatherAPI
    public function getWeatherData()
    {
        Auth::check() ? $city = Auth::user()->city : $city = 'Warsaw';
        $apiKey = env('WEATHER_API_KEY');
        $url = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city";

        try {
            $response = file_get_contents($url);
            $weatherData = json_decode($response, true);
            return response()->json($weatherData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch weather data'], 500);
        }
    }
}
