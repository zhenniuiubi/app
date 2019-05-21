<?php
namespace aliyun;
use aliyun\api_demo\SmsDemo;

class Alisms
{
    private static $_insatance = null;
    /**
     * 私有化构造函数 类必须通过单例模式调用
     */
    private function __construct()
    {
    }

    /**
     * 静态方法,单例模式统一入口
     */
    public static function getInstance()
    {
        if (is_null(self::$_insatance)) {
            self::$_insatance = new self();
        }
        return self::$_insatance;
    }

    /**
     * 
     */
    public function smsIdentify($phone)
    {
        return SmsDemo::sendSms($phone);
    }
}
