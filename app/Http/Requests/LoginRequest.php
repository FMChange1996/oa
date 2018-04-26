<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

    //创建验证规则
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    //创建中文提示
    public function messages()
    {
        return [
            'username.required' => '用户名不能为空',
            'password.required' => '密码不能为空'
        ];
    }
}
