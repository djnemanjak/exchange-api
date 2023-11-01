<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\PurchaseCurrenciesEnum;
use App\Http\Responses\JsonResponseApi;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

class ConvertExchangeRequest extends FormRequest
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
        return [
            'from' => ['required', 'in:' . implode(',', array_column(PurchaseCurrenciesEnum::cases(), 'value'))],
            'amount' => ['required', 'numeric', 'gt:0'],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        Log::error(json_encode($validator->errors()->first()));
        throw new HttpResponseException(JsonResponseApi::error('Validation error', $validator->errors()->first()));
    }
}
