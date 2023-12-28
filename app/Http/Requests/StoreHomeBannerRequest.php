<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHomeBannerRequest extends FormRequest
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
            'src'=>'required|image',
            'alt'=>'nullable|max:200',
            'language_id'=>'required|exists:system_languages,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'src'=>__('pages/home/banner.photo'),
            'alt'=>__('pages/home/banner.alt'),
            'language_id'=>__('static.language'),
        ];
    }
}
