<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductStep1Request extends FormRequest
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
        return array_merge(validateMultiLang([
            "title" => ['sometimes', 'string', 'min:3', 'max:300'],
            'description' => ['sometimes', 'nullable', 'string', 'max:2000']
        ]), [
            'price' => ['required', 'numeric'],
            'amount' => ['required', 'min:1'],
            'video_url' => ['sometimes', 'nullable', 'url'],
            'category_id' => ['required', 'numeric', 'exists:categories,id']
        ]);
    }
}
