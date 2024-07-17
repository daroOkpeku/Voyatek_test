<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class email_confirm_req extends FormRequest
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
    'email'=>'required|email',
        'verification_code'=>'required|string',
        ];
    }
}