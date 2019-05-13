<?php

namespace app\api\controller;

use app\api\controller\Common;

class News extends Common
{
    public function index()
    {
        // 小伙伴仿照我们之前讲解的validate验证机制 去做相关校验
        $data = input('get.');
        $whereData['status'] = config('code.status_normal');
        if (!empty($data['catid'])) {
            $whereData['catid'] = input('get.catid', 0, 'intval');
        }
        if (!empty($data['title'])) {
            $whereData['title'] = ['like', '%'.$data['title'].'%'];
        }

        $this->getPageAndSize($data);
        $total = model('News')->getNewsCountByCondition($whereData);
        $news = model('News')->getNewsByCondition($whereData, $this->from, $this->size);

        $result = [
            'total' => $total,
            'page_num'  => ceil($total / $this->size),
            'list' => $this->getDealNews($news),
        ];
        return show(config('code.success'), 'OK', $result, 200);
    }
}
