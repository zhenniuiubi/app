<?php
namespace app\common\lib;

//生成证书
class Openssl
{
    //生成证书
    public function exportOpenSSLFile()
    {
        $config = array(
            "config"        => "D:/BtSoft/WebSoft/apache/conf/openssl.cnf",
            // "digest_alg"        => "sha512",
            "private_key_bits"     => 4096,           //字节数  512 1024 2048  4096 等
            "private_key_type"     => OPENSSL_KEYTYPE_RSA,   //加密类型
        );
        $res = openssl_pkey_new($config);
        // halt($res);
        if ($res == false) {
            return false;
        }
        openssl_pkey_export($res, $private_key, null, $config);
        $public_key = openssl_pkey_get_details($res);
        $public_key = $public_key["key"];
        
        file_put_contents("../cert_public.key", $public_key);
        file_put_contents("../cert_private.pem", $private_key);
        openssl_free_key($res);
    }

    //加密解密
    public function authcode($string, $operation = 'E')
    {
        $ssl_public     = file_get_contents("../cert_public.key");
        $ssl_private    = file_get_contents("../cert_private.pem");
        $pi_key         = openssl_pkey_get_private($ssl_private); //这个函数可用来判断私钥是否是可用的，可用返回资源id Resource id
        // halt($pi_key);
        $pu_key         = openssl_pkey_get_public($ssl_public); //这个函数可用来判断公钥是否是可用的
        if (false == ($pi_key || $pu_key)) {
            return '证书错误';
        }
        $data = "";
        if ($operation == 'D') {
            openssl_private_decrypt(base64_decode($string), $data, $pi_key); //私钥解密
        } else {
            openssl_public_encrypt($string, $data, $pu_key); //公钥加密
            $data = base64_encode($data);
        }
        return $data;
    }
}
