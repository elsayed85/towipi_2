<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        return [
            "name" => ['required', 'unique:countries,name'],
            'nicename' => ['required'],
            'iso' => ['required', 'string', 'min:2', 'max:2', 'unique:countries,iso'],
            'phonecode' => ['required', 'integer' , 'max:9999', 'unique:countries,phonecode'],
            'numcode' => ['nullable', 'integer' , 'max:9999', 'unique:countries,numcode'],
            'iso3' => ['nullable', 'string', 'min:3', 'max:3', 'unique:countries,iso3'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'name' => strtoupper($this->name),
            'nicename' => ucfirst($this->name)
        ]);
    }
}
