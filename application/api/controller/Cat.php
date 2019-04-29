<?php

namespace app\api\controller;

use app\api\controller\Common;

class Cat extends Common
{
    public function read()
    {
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
