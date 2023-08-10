<?php

namespace App\Services;

use App\Interfaces\WeatherGatewayInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class WeatherGateway implements WeatherGatewayInterface
{
    public function forecast(int $lat, int $lng): Collection
    {
        $response = Http::get(config('services.openmeteo.domain'), [
            'latitude'=> $lat,
            'longitude' => $lng,
            'current_weather' => true,
            'hourly' => 'temperature_2m,precipitation',
            'temperature_unit' => 'fahrenheit',
            'windspeed_unit' => 'mph',
            'precipitation_unit' => 'inch',
            'timezone' => 'auto'
        ]);
        return $response->collect();
    }
}
