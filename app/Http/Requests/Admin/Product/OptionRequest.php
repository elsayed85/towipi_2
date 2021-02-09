<?php

namespace App\Http\Requests\Admin\Product;

use App\Models\Product\OptionValue;
use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            "option_name" => ['required', 'string', 'min:2', 'max:40'],
            "values" => ['required', 'array', 'min:1', 'max:50']
        ];
    }

    public function prepareForValidation()
    {
        if ($this->has('values')) {
            $this->merge([
                "values" => collect(json_decode($this->values))->map(function ($el) {
                    return  $el->value;
                })->toArray()
            ]);
        }
    }
}
