<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                "title" => ['sometimes', 'min:3', 'max:50'],
                "fname" => ['sometimes', 'min:3', 'max:50'],
                "lname" => ['sometimes', 'nullable', 'min:3', 'max:50'],
                "phone_1" => ['sometimes', 'min:8', 'max:20'],
                "phone_2" => ['sometimes', 'nullable', 'min:8', 'max:20'],
                'country_id' => ['sometimes', 'exists:countries,id'],
                'governorate' => ['sometimes', 'string', 'min:3', 'max:60'],
                'city' => ['sometimes', 'string', 'min:3', 'max:60'],
                'address_name' => ['sometimes' , 'string', 'min:10', 'max:500'],
                'notes' => ['sometimes', 'nullable', 'max:5000']
            ];
        } elseif ($this->isMethod('POST')) {
            return [
                "title" => ['required', 'min:3', 'max:50'],
                "fname" => ['required', 'min:3', 'max:50'],
                "lname" => ['nullable', 'min:3', 'max:50'],
                "phone_1" => ['required', 'min:8', 'max:20'],
                "phone_2" => ['nullable', 'min:8', 'max:20'],
                'country_id' => ['required', 'exists:countries,id'],
                'governorate' => ['required', 'string', 'min:3', 'max:60'],
                'city' => ['required', 'string', 'min:3', 'max:60'],
                'address_name' => ['required' , 'string', 'min:10', 'max:500'],
                'notes' => ['nullable', 'max:5000']
            ];
        }
    }
}
