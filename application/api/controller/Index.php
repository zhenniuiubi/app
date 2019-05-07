<?php

namespace app\api\controller;

use app\api\controller\Common;

class Index extends Common
{
    /**
     * 获取首页接口
     * 1. 头图 4-6
     * 2/ 推荐位列表 默认40条
     */
    public function index()
    {
        $header =  model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($header);

        $positions = model('News')->getPositionNormalNews();
        $positions = $this->getDealNews($positions);

        $result = [
            'heads' => $heads,
            'positions' => $positions,
        ];
        return show(config('code.success'), 'OK', $result, 200);
    }
}
