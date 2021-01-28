<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->isAbleTo('personal_info-update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "fname" => ['sometimes', 'min:3', 'max:50'],
            "lname" => ['sometimes', 'nullable', 'min:3', 'max:50'],
            'phone' => ['sometimes', 'nullable', 'max:20', 'min:8'],
            'country_id' => ['required', 'exists:countries,id'],
            'email' => ['sometimes', 'email', 'unique:users,email,' . auth()->id() . ',id'],
        ];
    }
}
