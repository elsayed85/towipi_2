<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
        return  validateMultiLang([
            'title' => ['sometimes', 'nullable', 'min:3', 'max:200'],
            'body' => ['sometimes', 'nullable', 'min:5']
        ]);
    }

    public function prepareForValidation()
    {
        $this->merge(array_remove_null($this->all()));
    }
}
