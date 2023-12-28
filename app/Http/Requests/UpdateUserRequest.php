<?php

namespace App\Http\Requests;

use App\Rules\CorporateEmail;
use App\Rules\isValidPassword;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
//        dd('az');
        return [
            'name'=>'required|max:15',
            'last_name'=>'required|max:30',
            'email'=>['required',Rule::unique('users','email')->where(function ($query) {
                return $query->where('id','!=',request()->segment(3));
            })],
            'role_id'=>'required|exists:roles,id',
            'password' => ['min:6','required_with:password_confirmation','same:password_confirmation'],
            'password_confirmation' => 'min:6'
        ];
    }

    public function attributes(): array
    {
        return [
            'name'=>__('static.name'),
            'last_name'=>__('static.last_name'),
            'email'=>__('static.email'),
            'role_id'=>__('static.role'),
            'password' =>__('static.password'),
            'password_confirmation' =>__('static.password_confirmation'),
        ];
    }
}
