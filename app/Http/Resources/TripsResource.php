<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $name
 * @property int $id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property User $user
 */
class TripsResource extends JsonResource
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
                'name' => $this->name,
                'created_at' => $this->created_at,
                'updated_at' => $this->updated_at,
            ],
            'relationships' => [
                'user' => [
                    'id' => (string) $this->user->id,
                    'name' => (string) $this->user->name,
                    'email' => (string) $this->user->email,
                ],
                'waypoints' => WaypointsResource::collection($this->waypoints),
            ],
        ];
    }
}
