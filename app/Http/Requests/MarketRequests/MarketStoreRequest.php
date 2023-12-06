<?php

namespace App\Http\Requests\MarketRequests;

use Illuminate\Foundation\Http\FormRequest;

class MarketStoreRequest extends FormRequest
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
            'footballer_id'=>'required|exists:App\Models\Footballer,id',
            'price' => 'required|max:255|min:3',
        ];
    }
}
