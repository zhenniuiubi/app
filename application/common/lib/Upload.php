<?php
namespace app\common\lib;
//引入鉴权类
use Qiniu\Auth;
//引入上传类
use Qiniu\Storage\UploadManager;

class Upload
{
    /**
     * 图片上传
     */
    public static function image(){
        halt($_FILES['image']);
        if (empty($_FILES['file']['tmp_name'])) {
            exception('您提交的图片不合法',404);
        }
    }
}
