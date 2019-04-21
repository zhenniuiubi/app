<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\lib\IAuth;
use app\common\lib\Aes;

/**
 * api模块 公共控制方法
 */
class Common extends Controller
{
    //初始化的方法
    public function _initialize()
    {
        $this->checkRequestAuth();
        $this->testAes();
    }

    /**
     * 检查每次app请求的数据是否合法
     */
    public function checkRequestAuth()
    {
        //首先需要获取headers
        $headers = request()->header();
        // if (empty($headers['sign'])) {
        //     exception('sign不存在');
        // }
        // if (!in_array($headers['app_type'], config('app.apptypes'))) {
        //     exception('app_type不合法');
        // }
        //需要sign
        $data = $headers;
        IAuth::checkSignPass($data);
    }

    public function testAes()
    {
        $data = [
            'did' => '12345dg',
            'version' => 1,
        ];
        $str = 'Nrgp+sL7dD4hqJ8Eo0qYpCzh70odyxLETCuhmRx1OW8=';
        // echo IAuth::setSign($data);
        return (new Aes())->decrypt($str);
        exit;
    }
}
