<?php

namespace App\Http\Requests\Api\V1;

class CreateOrderRequest extends ConvertExchangeRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return parent::rules() + [
                'totalAmount' => ['required', 'numeric', 'gt:0'],
            ];
    }
}
