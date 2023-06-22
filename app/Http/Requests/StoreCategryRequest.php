<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCategryRequest extends FormRequest
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
            'name' => [
                'required',
                'max:20',
                Rule::unique('categries')->whereNull('deleted_at'),
            ],
            'description' => 'required',
        ];
    }

}
