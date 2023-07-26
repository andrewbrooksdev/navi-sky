<?php

namespace App\Http\Controllers;

use App\Services\WeatherGateway;
use App\Http\Resources\WeatherResource;
use App\Http\Requests\GetWeatherRequest;

class WeatherController extends Controller
{
    public function getForecast(WeatherGateway $gateway, GetWeatherRequest $request)
    {
        $request->validated($request->all());

        $response = $gateway->forecast($request->lat, $request->lng);

        return new WeatherResource($response);
    }
}
