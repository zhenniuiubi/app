<?php
namespace app\index\controller;

use think\Controller;
use dysms\Alisms;

class Index extends Controller
{
    public function index()
    {
        $Alisms = new Alisms();
        $phone = '17620017621';
        echo $Alisms->code($phone,$msg);
        // die;
        // return '1';
    }

    public function code()
    {
        $test = new Test(); //这个类我放在了Common\Controller\下面,你们随意哈
        echo $test->code();
    }
}
