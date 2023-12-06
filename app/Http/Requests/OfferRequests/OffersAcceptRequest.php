<?php

namespace App\Http\Requests\OfferRequests;

use Illuminate\Foundation\Http\FormRequest;

class OffersAcceptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'receiver_id'=>'exists:App\Models\User,id',
            'market_id'=>'exists:App\Models\Market,id',
            'offer_type'=>'max:255|min:3',
        ];
    }
}
