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
        echo $this->getLastSql();
        return $result;
    }

    /*
     * 根据条件获取表里数据
     * @param array $param
     */
    public function getNewsByCondition($param=[])
    {
        $condition['status'] = [
            'neq',config('code.status_delete')
        ];
        $order = ['id'=>'desc'];
        $from = ($param['page'] -1) * $param['size'];

        $result = $this->where($condition)
            ->limit($from,$param['size'])
            ->order($order)
            ->select();
        echo $this->getlastsql();
    }
}
