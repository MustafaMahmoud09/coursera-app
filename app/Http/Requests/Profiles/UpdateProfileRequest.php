<?php

namespace App\Http\Requests\Profiles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'name' => [
                'sometimes',
                'nullable',
                'string',
                'max:255',
                'min:6'
            ],
            'email' => [
                'sometimes',
                'nullable',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'password' => [
                'sometimes',
                'nullable',
                'string',
                'confirmed',
                'max:50',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'old_password' => [
                'sometimes',
                'nullable',
                'string',
                'max:50',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'avatar' => ['sometimes', 'image']
        ];
    }
}//end UpdateProfileRequest
