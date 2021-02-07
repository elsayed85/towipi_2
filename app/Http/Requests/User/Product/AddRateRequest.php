<?php

namespace App\Http\Requests\User\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return ($this->order->user_id == auth()->id() && $this->order->isPaid()) && ($this->order->items()->whereId($this->item->id)->exists());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "rate_value" => ['required', 'numeric', 'between:1,5'],
            'review' => ['nullable', 'max:300']
        ];
    }
}
