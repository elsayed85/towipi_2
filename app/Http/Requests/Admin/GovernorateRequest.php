<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
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
        if ($this->isMethod('POST')) {
            return [
                "name_en" => ['required', 'min:2', 'max:100', 'string'],
                'shipping_price' => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
                'country_id' => ['required', 'integer', 'exists:countries,id']
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod("PATCH")) {
            return [
                "name_en" => ['sometimes', 'min:2', 'max:100', 'string'],
                'shipping_price' => ['sometimes', 'regex:/^\d+(\.\d{1,2})?$/'],
                'country_id' => ['sometimes', 'integer', 'exists:countries,id']
            ];
        }
    }
}
