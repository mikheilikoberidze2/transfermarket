<?php

namespace App\Http\Requests\FootballerRequests;

use Illuminate\Foundation\Http\FormRequest;

class FootballerStoreRequest extends FormRequest
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
            'name' => 'required|max:255|min:3',
            'lastname' => 'required|max:255|min:3',
            'club_id'=>'required|exists:App\Models\Club,id',
            'national_id'=>'required|exists:App\Models\National,id',
        ];
    }
}
