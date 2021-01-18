<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            return array_merge([
                'slug' => ['required', 'min:3', 'max:100', 'unique:site_pages,slug'],
            ], validateMultiLang(['title' => ['sometimes', 'nullable', 'min:3', 'max:40'],]));
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return array_merge([
                'slug' => ['sometimes', 'min:3', 'max:100', 'unique:site_pages,slug,' . $this->page->id . ',id'],
            ], validateMultiLang(['title' => ['sometimes', 'min:3', 'max:40'], 'body' => ['sometimes'],]));
        }
    }

    public function prepareForValidation()
    {
        $this->merge(array_remove_null($this->all()));
    }
}
