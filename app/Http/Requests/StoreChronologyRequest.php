<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreChronologyRequest extends FormRequest
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
            'date'=>'required|max:50',
            'my_content'=>'required|max:65000',
            'language_id'=>'required|exists:system_languages,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'date'=>__('pages/home/chronology.date'),
            'my_content'=>__('pages/home/chronology.content'),
            'language_id'=>__('static.language'),
        ];
    }
}
