<?php

namespace App\Http\Requests\Api;

class AuthorizationRequest extends FormRequest
{
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|alpha_dash|min:6', //alpha_dash 验证的字段可能具有字母、数字、破折号（ - ）以及下划线（ _ ）。
        ];
    }
}
