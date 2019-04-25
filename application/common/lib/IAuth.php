<?php
namespace app\common\lib;

use app\common\lib\Aes;

class IAuth
{
    /**
     * 设置密码
     * @param string $data
     * @return string
     */
    public static function setPwd($data)
    {
        return md5($data.config('app.pwd_suffix'));
    }

    /**
     * 生成每次请求的sign
     * @param array $data
     * @return string
     */
    public static function setSign($data=[])
    {
        // 1 按字段排序
        ksort($data);
        // 2 拼接数据 用 &
        $string = http_build_query($data);
        halt($string);
        // 3 用aes加密
        $string = (new Aes())->encrypt($string);

        return $string;
    }

    /**
     * 检查sign是否正常
     */
    public static function checkSignPass($headers)
    {
        $str = (new Aes())->decrypt($headers['sign']);
        if (empty($str)) {
            return false;
        }
        parse_str($str, $arr);
        if (!is_array($arr)||empty($arr['did'])||$arr['did']!=$headers['did']) {
            return false;
        }
        return true;
    }
}
