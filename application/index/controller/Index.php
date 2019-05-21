<?php
namespace app\index\controller;

use think\Controller;
use aliyun\api_demo\SmsDemo;
use aliyun\Alisms;

class Index extends Controller
{
    public function index()
    {
        $result = SmsDemo::sendSms(17620017621);
        echo $result->Message;
        // $res = Alisms::getInstance()->smsIdentify(17620017621);
        // halt($res);
        // die;
        // return '1';
    }

    public function code()
    {
        $test = new Test(); //这个类我放在了Common\Controller\下面,你们随意哈
        echo $test->code();
    }
}
