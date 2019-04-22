<?php

namespace app\api\controller;

use think\Controller;
use think\Request;
use app\common\lib\IAuth;
use app\common\lib\Aes;
use app\common\lib\exception\ApiException;

/**
 * api模块 公共控制方法
 */
class Common extends Controller
{
    public $headers = '';
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
        if (empty($headers['sign'])) {
            throw new ApiException('sign不存在', 400);
        }
        if (!in_array($headers['apptype'], config('app.app_types'))) {
            throw new ApiException('apptype不合法', 400);
        }
        //需要sign
        if (!IAuth::checkSignPass($headers)) {
            //未授权
            throw new ApiException('授权码sign失败', 401);
        }
        $this->headers = $headers;
    }

    public function testAes()
    {
        $data = [
            'did' => '12345dg',
            'version' => 1,
        ];
        $str = 'Nrgp+sL7dD4hqJ8Eo0qYpCzh70odyxLETCuhmRx1OW8=';
        // echo IAuth::setSign($data);
        // echo (new Aes())->decrypt($str);
    }
}
