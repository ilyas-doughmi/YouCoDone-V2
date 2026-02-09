<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'restaurant_id' => ['required', 'exists:restaurant,id'],
            'date' => ['required','date','after_or_equal:today'],
            'heure' => ['required'],
            'nombre_personnes' => ['required','integer','min:1','max:5'],
        ];
    }

    public function messages()
    {
        return [
            'date.after_or_equal' => 'you can\'t make old reservation',
            'nombre_personnes.min' => 'you need at least 1 person',
            'nomber_personnes.max' => 'max is 5 personnes',
        ];
    }
}
