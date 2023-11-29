<?php

namespace App\Http\Requests\FootballerRequests;

use Illuminate\Foundation\Http\FormRequest;

class FootballerUpdateRequest extends FormRequest
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
            'name' => 'max:255|min:3',
            'lastname' => 'max:255|min:3',
            'club_id'=>'exists:App\Models\Club,id',
            'national_id'=>'exists:App\Models\National,id',
        ];
    }
}
