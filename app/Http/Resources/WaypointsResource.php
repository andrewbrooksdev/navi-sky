<?php

namespace App\Http\Resources;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $name
 * @property mixed $updated_at
 * @property mixed $created_at
 * @property Trip $trip
 * @property float $lat
 * @property float $lng
 * @property mixed $depart_at
 */
class WaypointsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'attributes' => [
                'lat' => $this->lat,
                'lng' => $this->lng,
                'depart_at' => $this->depart_at,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'trip' => [
                    'id' => (string) $this->trip->id,
                    'name' => (string) $this->trip->name,
                ],
            ],
        ];
    }
}
