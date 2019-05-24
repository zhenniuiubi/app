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
        // 3 用aes加密
        $string = (new Aes())->encrypt($string);

        return $string;
    }

    /**
     * 检查sign是否正常
     */
    public static function checkSignPass($data)
    {
        $str = (new Aes())->decrypt($data['sign']);
        if (empty($str)) {
            return false;
        }
        parse_str($str, $arr);
        if (!is_array($arr)||empty($arr['did'])||$arr['did']!=$data['did']) {
            halt(3);
            return false;
        }
        if (!config('app_debug')) {
            if ((time()-ceil($arr['time']/1000)) > config('app.app_sign_time')) {
                return false;
            }
            //唯一性判定
            if (cache($data['sign'])) {
                //TODO:???
                return false;
            }
        }
        return true;
    }
    //设置登陆的token
    public static function setAppLoginToken($phone='')
    {
        $str =  md5(uniqid(microtime(true), true));
        $str = sha1($str.$phone);
        return $str;
    }
}
