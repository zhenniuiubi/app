<?php
namespace app\common;
use app\extend\dysms\Alisms;
class Test
{

    public function code(){
        // return 2;
        $code = new Alisms(); //这个类我放在了Common\Controller\下面,你们随意哈
        $code->code("15912345678",$msg);
        echo $msg;
    }
}