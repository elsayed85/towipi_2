<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminCrudRequest extends FormRequest
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
                'name' => ['required', 'min:3', 'max:40'],
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required', 'min:3', 'max:40'],
                'roles' => ['array'],
                'roles.*' => ['numeric', 'exists:roles,id']
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name' => ['sometimes', 'min:3', 'max:40'],
                'email' => ['sometimes', 'email', 'unique:users,email,' . $this->admin->id . ',id'],
                'password' => ['sometimes', 'nullable', 'min:3', 'max:40']
            ];
        }
    }
}
