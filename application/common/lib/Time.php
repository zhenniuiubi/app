<?php
namespace app\common\lib;

class Time
{
    /**
     * 返回13位时间戳
     */
    private function __construct()
    {
    }
    public function get13Timestamp()
    {
        list($t1, $t2) = explode(' ', microtime());
        return $t2.ceil(($t1*1000));
    }
}
