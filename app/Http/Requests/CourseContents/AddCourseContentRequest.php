<?php

namespace App\Http\Requests\CourseContents;

use Illuminate\Foundation\Http\FormRequest;

class AddCourseContentRequest extends FormRequest
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
            'status' => 'required|in:0,1|numeric',
            'title' => 'required|min:6|max:30',
            'description' => 'required|min:1|max:500',
            'avatar' => 'required|image',
            'playlist' => 'required|exists:courses,id',
            'type' => 'required|exists:content_types,id'
        ];
    }

}//end AddCourseContentRequest
