<?php

namespace App\Http\Requests\User\web;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\VerificationService;

class AddUserRequest extends FormRequest
{

    public function authorize(){
        return app(VerificationService::class)->isAdmin($this);
    }

    public function rules()
    {
        return [
            'email'             => 'required|string|email|unique:users',
            'tel_number'        => 'required|unique:users',
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
