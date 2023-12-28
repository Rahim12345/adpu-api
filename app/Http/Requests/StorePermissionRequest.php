<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermissionRequest extends FormRequest
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
            'checked'=>['required',Rule::in(['true','false'])],
            'route_name'=>'required|exists:route_lists,route_name',
            'action'=>['required',Rule::in(['create','index','edit','delete'])],
            'user_id'=>'required|exists:users,id'
        ];
    }

    public function attributes(): array
    {
        return [
            'checked'=>'İcazə',
            'route_name'=>'Route Name',
            'action'=>'Action',
            'user_id'=>'İstifadəçi',
        ];
    }
}
