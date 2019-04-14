<?php

namespace app\admin\controller;

use think\Controller;

class Base extends Controller
{
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
}
