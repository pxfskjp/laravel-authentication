<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user.login' => 'required|min:3|max:60|unique:users,login',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|min:8|max:36|confirmed'
        ];
    }
}
