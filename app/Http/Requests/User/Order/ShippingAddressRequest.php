<?php

namespace App\Http\Requests\User\Order;

use Illuminate\Foundation\Http\FormRequest;

class ShippingAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->order->user_id == auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->has('address_id')) {
            return [
                'address_id' => ['required', 'numeric', 'exists:addresses,id']
            ];
        } else {
            return [
                "fname" => ['required', 'min:3', 'max:50'],
                "lname" => ['nullable', 'min:3', 'max:50'],
                "phone_1" => ['required', 'min:8', 'max:20'],
                "phone_2" => ['nullable', 'min:8', 'max:20'],
                'governorate_id' => ['required', 'numeric', 'exists:governorates,id'],
                'city' => ['required', 'string', 'min:3', 'max:60'],
                'name' => ['required', 'string', 'min:10', 'max:500'],
                'notes' => ['sometimes', 'nullable', 'max:1000']
            ];
        }
    }
}
