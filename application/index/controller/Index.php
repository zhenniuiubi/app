<?php
namespace app\index\controller;

use think\Controller;
use app\common\lib\IAuth;
use aliyun\api_demo\SmsDemo;
use app\common\model\AdminUser;

class Index extends Controller
{
    public function index()
    {
        $data = [
            // 'username' => 'test1',
            // 'status' => 1,
        ];
        $user = AdminUser::create($data);
        // dump((bool)$user);
        if ($user && $user['id']) {
            echo $user['id'];
        }else{
            echo '添加失败';
        }
        // $res = SmsDemo::sendSms('17620017621');
        // halt($res);
        // echo IAuth::setAppLoginToken('17620017621');
    }

    public function code()
    {
        $test = new Test(); //这个类我放在了Common\Controller\下面,你们随意哈
        echo $test->code();
    }
}
