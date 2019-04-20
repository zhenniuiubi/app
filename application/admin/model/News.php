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
        // echo $this->getLastSql();
        return $result;
    }

    /*
     * 根据条件获取表里数据
     * @param array $param
     */
    public function getNewsByCondition($condition=[],$from=0,$size=5)
    {
        $condition['status'] = [
            'neq',config('code.status_delete')
        ];
        $order = ['id'=>'desc'];

        $result = $this->where($condition)
            ->limit($from,$size)
            ->order($order)
            ->select();
        return $result;
        // echo $this->getlastsql();
    }

    public function getNewsCountByCondition($condition=[])
    {
        $condition['status'] = [
            'neq',config('code.status_delete')
        ];
        return $this->where($condition)->count();
    }
}
