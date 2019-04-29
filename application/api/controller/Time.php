<?php

namespace app\api\controller;

use app\api\controller\Common;

class Time extends Common
{
    //与APP时间对比 保持一致
    public function checkTime()
    {
        return show(1, 'ok', time());
    }
}
