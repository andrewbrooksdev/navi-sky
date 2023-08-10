<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GetWeatherRequest extends FormRequest
{
    public mixed $lat;
    public mixed $lng;

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
            'lat' => ['required', 'integer', 'numeric'],
            'lng' => ['required', 'integer', 'numeric']
        ];
    }
}
