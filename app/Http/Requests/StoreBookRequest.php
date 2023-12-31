<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Log;

use Illuminate\Foundation\Http\FormRequest;


class StoreBookRequest extends FormRequest
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
            'title' => 'required|string|max:30',
            'description' => 'required|string',
            'author_id' => 'exists:authors,id',
            'category_id' => 'required|array',
            'category_id.*' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:1000'  
              ];
              
    }

    
}
