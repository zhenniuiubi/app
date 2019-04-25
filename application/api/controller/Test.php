<?php

namespace app\api\controller;

use app\api\controller\Common;
use app\common\lib\Aes;

class Test extends Common
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save()
    {
        $data = input('post.');
        halt($data);
        // if ($data['mt'!=1]) {
        //     throw new ApiException('提交的数据不合法', 403);
        // }
        return show(1, 'ok', input('post.'), 201);
    }
}
