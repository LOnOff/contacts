<?php

namespace App\Http\Requests\Contact\web;

use App\Services\VerificationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddContactRequest extends FormRequest
{

    public function authorize()
    {
        return app(VerificationService::class)->isAdmin($this);
    }

    public function rules()
    {
        return [
            'tel_number'        => [
                'nullable',
                'string',
                Rule::unique('contacts')->ignore($this->id)],
            'last_name'         => 'required|string',
            'first_name'        => 'required|string',
            'middle_name'       => 'required|string',
        ];
    }
}
