<?php

namespace App\Interfaces;

interface WeatherGatewayInterface
{
    public function forecast(int $lat, int $lng);
}