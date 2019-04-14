<?php
namespace app\common\validate;

use think\Validate;

class Login extends Validate
{
    protected $rule = [
        'username' => 'require|max:20|min:5',
        'password' => 'require|max:20|min:6',
    ];

    protected $message = [
        'username.max' => '用户名或密码不正确，请重试。',
        'username.min' => '用户名或密码不正确，请重试。',
        'password.max' => '用户名或密码不正确，请重试。',
        'password.min' => '用户名或密码不正确，请重试。',
    ];
}
