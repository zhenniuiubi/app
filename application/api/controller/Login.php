<?php

namespace app\api\controller;

use app\api\controller\Common;
use aliyun\api_demo\SmsDemo;
use app\common\lib\IAuth;
use app\common\model\AdminUser;

class Login extends Common
{
    public function save()
    {
        if (!request()->isPost()) {
            return show(config('code.error'), '没有权限', '', 403);
        }
        $param = input('param.');
        if (empty($param['phone'])) {
            return show(config('code.error'), '手机号不合法', '', 404);
        }
        if (empty($param['code'])) {
            return show(config('code.error'), '手机短信验证码不合法', '', 404);
        }
        //validate严格校验
        $code = SmsDemo::checkSmsIdentify($param['phone']);
        if ($code != $param['code']) {
            return show(config('code.error'), '短信验证码不正确或者已过期', '', 404);
        }
        //第一次登陆 注册数据
        $data = [
            'token' => IAuth::setAppLoginToken($param['phone']),
            'time_out' => strtotime('+'.config('app.login_time_out_day').'days'),
            'username' => 'hehexia'.$param['phone'],
            'status' => 1,
            'phone' => $param['phone'],
        ];
        $user = AdminUser::create($data);
        if ($user && $user['id']) {
            echo '注册成功';
        } else {
            echo '注册失败';
        }
    }
}
