<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAccountRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|max:20',
            'last_name' =>'required|max:20',
            'password' =>'required|min:8|max:20',
            'ypassword' =>'required|min:8|max:20',
        ];
    }

    public function attributes()
    {
        return [
            'name' =>'Ad',
            'last_name' =>'Soyad',
            'password' =>'Şifrə',
            'ypassword' =>'Yeni şifrə',
        ];
    }
}
