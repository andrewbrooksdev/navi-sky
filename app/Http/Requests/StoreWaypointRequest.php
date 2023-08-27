<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $name
 * @property int $trip_id
 * @property mixed $lat
 * @property mixed $lng
 * @property mixed $depart_at
 */
class StoreWaypointRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'trip_id' => ['required', 'integer', 'numeric'],
            'lat' => ['required', 'numeric'],
            'lng' => ['required', 'numeric'],
            'depart_at' => ['required', 'date', 'date'],
        ];
    }
}
