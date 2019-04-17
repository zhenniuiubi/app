<?php

namespace app\admin\model;

use app\admin\model\Base;

class AdminUser extends Base
{
    public function add($data)
    {
        $res = $this->get(['username'=>$data['username']]);
        if ($res) {
            exception('还用户名已被注册!');
        } else {
            $this->allowField(true)->save($data);
            return $this->id;
        }
    }
}
