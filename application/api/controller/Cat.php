<?php

namespace app\api\controller;

use app\api\controller\Common;
use think\Controller;

class Cat extends Controller
{
    public function read()
    {
        //TODO::解决模块找不到的BUG
        $cats = config('cat.list');
        $result[] = [
            'cat_id' => 0,
            'cat_name' => '首页',
        ];
        foreach ($cats as $catid => $catname) {
            $result[] = [
                'cat_id'=> $catid,
                'catname'=> $catname,
            ];
        }
        return show(config('code.success'), 'oK', $result, 200);
    }
}
