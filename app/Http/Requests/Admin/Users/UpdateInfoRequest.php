<?php

namespace App\Http\Requests\Admin\Users;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoRequest extends FormRequest
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
                'fname' => ['required', 'min:3', 'max:40'],
                'lname' => ['sometimes', 'nullable', 'min:3', 'max:40'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:3', 'max:40'],
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'fname' => ['sometimes', 'min:3', 'max:40'],
                'lname' => ['sometimes', 'nullable', 'min:3', 'max:40'],
                'email' => ['sometimes', 'email', 'unique:users,email,' . $this->user->id . ',id'],
                'password' => ['sometimes', 'nullable', 'min:3', 'max:40'],
            ];
        }
    }
}
