<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
    public $page = '';
    //每页显示多少条
    public $size = '';
    //查询条件的起始页
    public $from = 0;
    /**
     * 后台基础类库
     */
    public function _initialize()
    {
        $isLogin = $this->isLogin();
        if (!$isLogin) {
            return $this->redirect('login/index');
        }
    }

    /**
     * 判断是否登录
     */
    public function isLogin()
    {
        $user = session(config('admin.session_user'), '', config('admin.session_user_scope'));
        if($user && $user['id']){
            return true;
        }
        return false;
    }

    /**
     * 获取分页的page和size
     */
    public function getPageAndSize($data)
    {
        $this->page = !empty($data['page'])?$data['page']:1;
        $this->size = !empty($data['size'])?$data['size']:config('paginate.list_rows');
        $this->from = ($this->page -1) * $this->size;
    }
}
