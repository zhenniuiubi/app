<?php
namespace app\index\controller;
use think\Controller;

use app\common\lib\Time;
use app\common\Test;
class Index extends Controller
{
    public function index()
    {
        $time = new Time();
        echo $time->get13Timestamp();die;
        // return '1';
    }

    public function code(){
        $test = new Test(); //这个类我放在了Common\Controller\下面,你们随意哈
        echo $test->code();
    }
}
