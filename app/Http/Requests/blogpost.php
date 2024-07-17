<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class blogpost extends FormRequest
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
            'heading'=>'required|string|size:500',
            'body'=>'required|string|size|5000',
            'author'=>"required|string|150",
        ];
    }
}
