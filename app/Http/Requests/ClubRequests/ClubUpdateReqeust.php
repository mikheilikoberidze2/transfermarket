<?php

namespace App\Http\Requests\ClubRequests;

use Illuminate\Foundation\Http\FormRequest;

class ClubUpdateReqeust extends FormRequest
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
            'manager_id'=>'exists:App\Models\User,id',
        ];
    }
}
