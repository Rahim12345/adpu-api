<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSpecialProgramRequest extends FormRequest
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
            'program_name'=>'required|max:200',
            'program_description'=>'required|max:65000',
            'language_id'=>'required|exists:system_languages,id',
        ];
    }

    public function attributes(): array
    {
        return [
            'program_name'=>__('pages/home/special-programs.program_name'),
            'program_description'=>__('pages/home/special-programs.program_description'),
            'language_id'=>__('static.language'),
        ];
    }
}
