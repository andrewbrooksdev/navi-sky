<?php

namespace App\Http\Controllers;

use App\Services\WeatherGateway;
use App\Http\Resources\WeatherResource;

class WeatherController extends Controller
{
    public function getForecast(WeatherGateway $gateway)
    {
        $response = $gateway->forecast(45.6425472,-122.5490432);

        return new WeatherResource($response);
    }
}
