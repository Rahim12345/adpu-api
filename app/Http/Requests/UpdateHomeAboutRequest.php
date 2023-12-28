<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateHomeAboutRequest extends FormRequest
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
            'src'=>'nullable|image',
            'alt'=>'nullable|max:200',
            'language_id'=>'required|exists:system_languages,id',
            'icon'=>'nullable|max:200',
            'title_1'=>'nullable|max:200',
            'intro_text'=>'nullable|max:65000',
        ];
    }

    public function attributes(): array
    {
        return [
            'src'=>__('pages/home/about.photo'),
            'alt'=>__('pages/home/about.alt'),
            'language_id'=>__('static.language'),
            'icon'=>__('pages/home/about.icon'),
            'title_1'=>__('pages/home/about.title_1'),
            'title_2'=>__('pages/home/about.title_2'),
            'intro_text'=>__('pages/home/about.intro_text'),
        ];
    }
}
