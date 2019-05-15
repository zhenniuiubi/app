<?php
namespace app\common\model;

use think\Model;

// use app\common\model\Base;

class Version extends Model
{
    public function getLastVersionByAppType($app_type = '')
    {
        $data = [
            'status' => 1,
            'app_type' => $app_type,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->limit(1)
            ->find();
    }
}
