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
        $res = SmsDemo::sendSms('17620017621');
        halt($res);
        // echo cache(17620017621);
        // echo IAuth::setAppLoginToken('17620017621');
    }

    public function code()
    {
    }
}
