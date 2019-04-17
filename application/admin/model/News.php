<?php

namespace app\admin\model;

use app\admin\model\Base;

class News extends Base
{
    /**
     * 后台自动化分页
     * @param array $data
     */
    public function getNews($data=[])
    {
        $data['status'] = [
            'neq',config('code.status_delete')
        ];
        $order = ['id'=>'desc'];
        $result = $this->where($data)
            ->order($order)
            ->paginate();
        return $result;
    }
}
