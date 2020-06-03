<?php

namespace App\Http\Requests\Contact\web;

use App\Services\VerificationService;
use Illuminate\Foundation\Http\FormRequest;

class DeleteContactRequest extends FormRequest
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
