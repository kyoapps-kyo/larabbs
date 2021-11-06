<?php

namespace App\Http\Requests\Api;

class SocialAuthorizationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'code' => 'required_without:access_token|string', //access_token不存在，code就必须存在且不为空。
            'access_token' => 'required_without:code|string', //code不存在，access_token就必须存在且不为空。
        ];

        if ($this->social_type == 'wechat' && !$this->code) {
            $rules['openid']  = 'required|string';
        }

        return $rules;
    }
}
