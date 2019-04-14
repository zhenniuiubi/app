<?php
namespace app\common\lib;

class IAuth
{
    public static function setPwd($data)
    {
        return md5($data.config('app.pwd_suffix'));
    }
}
