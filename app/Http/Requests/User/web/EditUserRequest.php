<?php

namespace App\Http\Requests\User\web;

use App\Services\VerificationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EditUserRequest extends FormRequest
{

    public function authorize()
    {
        return app(VerificationService::class)->isAdmin($this);
    }

    public function rules()
    {
        return [
            'id'                => 'required',
            'email'             => [
                'nullable',
                'email',
                'string',
                Rule::unique('users')->ignore($this->id)],
            'tel_number'        => [
                'nullable',
                'string',
                Rule::unique('users')->ignore($this->id)],
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
