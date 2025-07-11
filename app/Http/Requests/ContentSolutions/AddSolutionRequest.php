<?php

namespace App\Http\Requests\ContentSolutions;

use Illuminate\Foundation\Http\FormRequest;

class AddSolutionRequest extends FormRequest
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
            'pdf' => 'required|mimes:pdf',
        ];
    }

}//end AddSolutionRequest
