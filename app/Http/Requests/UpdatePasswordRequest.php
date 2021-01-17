<?php

namespace App\Http\Requests;

use App\Rules\OldPasswordMatched;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
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
            "password" => ['required' , new OldPasswordMatched],
            'new_password' => ['required', 'min:6', 'max:40', 'confirmed']
        ];
    }
}
