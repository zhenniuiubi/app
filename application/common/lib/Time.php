<?php
namespace app\common\lib;

class Time
{
    /**
     * 图片上传
     */
    public static function get13Timestamp()
    {
        list($t1, $t2) = explode(' ', microtime());
        return $t2.ceil(($t1*1000));
    }
}
