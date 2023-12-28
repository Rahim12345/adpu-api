<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
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
            'question'=>'required|max:200',
            'answer'=>'required|max:65000',
            'language_id'=>'required|exists:system_languages,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'question'=>__('pages/home/faq.question'),
            'answer'=>__('pages/home/faq.answer'),
            'language_id'=>__('static.language'),
        ];
    }
}
