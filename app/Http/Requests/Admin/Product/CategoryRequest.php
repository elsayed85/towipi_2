<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => ['sometimes', 'min:3', 'max:200'],
        ]) + ['parent_id' => ['sometimes', 'nullable', 'exists:categories,id']];
    }

    public function prepareForValidation()
    {
        $this->merge(array_remove_null($this->all()));
    }
}
