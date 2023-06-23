<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:30',
            'description' => 'string',
            'author_id' => 'exists:authors,id',
            'category_id' => 'array',
            'category_id.*' => 'exists:categories,id',
            'image' => 'nullable|image|max:10000'  
        ];
    }
}
