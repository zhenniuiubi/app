<?php

namespace app\common\model;

use think\Model;

class News extends Model
{
    public function getNewsByCondition($condition=[])
    {
        $condition['status'] = [
            'neq',config('code.status_delete')
        ];
        return $this->where($condition)->count();
    }

    /**
     * 获取首页头图数据
     * @param int $num
     * @return array
     */
    public function getIndexHeadNormalNews($num=4)
    {
        $data = [
            'status' => 1,
            'is_head_figure' => 1,
        ];
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
                    ->field($this->_getLIstField())
                    ->order($order)
                    ->limit($num)
                    ->select();
    }

    /**
     * 获取推荐的数据
     * @param int $num
     * @return array
     */
    public function getPositionNormalNews($num=20)
    {
        $data = [
            'status' => 1,
            'is_head_figure' => 1,
        ];
        $order = [
            'id' => 'desc',
        ];
        return $this->where($data)
                    ->field($this->_getLIstField())
                    ->order($order)
                    ->limit($num)
                    ->select();
    }
    /**
     * 通用化获取参数的数据字段
     */
    private function _getLIstField()
    {
        return [
            'id','catid','image','title','read_count',
        ];
    }
}
