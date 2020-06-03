<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class SignUpUserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'             => 'required|string|email|unique:users',
            'tel_number'        => 'required|unique:users',
            'password'          => 'required|string|confirmed',
            'last_name'         => 'required|string',
            'first_name'        => 'required|string',
            'middle_name'       => 'required|string',
            'birth_date'        => 'required',
            'city'              => 'required|string',
            'street'            => 'required|string',
            'house'             => 'required|string',
        ];
    }

}

