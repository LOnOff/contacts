<?php

namespace App\Http\Requests\User\web;

use App\Services\VerificationService;
use Illuminate\Foundation\Http\FormRequest;

class DeleteUserRequest extends FormRequest
{

    public function authorize()
    {
        return app(VerificationService::class)->isAdmin($this);
    }

    public function rules()
    {
        return [
            'id'                => 'required',
        ];
    }

}
