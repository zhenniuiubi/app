<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\common\lib\Upload;
/**
 * 后台图片上传
 */
class Image extends Base
{
    public function upload()
    {
        $file = request()->file('image');
        $info = $file->move('upload');
        if ($info && $info->getPathName()) {
            $data = [
                'status' => 1,
                'message' => 'ok',
                'data' => '/'.$info->getPathname(),
            ];
            echo json_encode($data);exit;
        }
        echo json_enco(['status'=>0,'message'=>'上传失败']);
    }
}
