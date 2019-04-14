<?php

namespace app\admin\controller;

use app\admin\controller\Base;
use think\Request;
use app\admin\model\AdminUser;
use app\common\lib\IAuth;

class Login extends Base
{
    //方法重载,防止死循环
    public function _initialize(){}

    public function index()
    {
        //如果用户已登录,就需要跳转到后台页面
        if ($this->isLogin()) {
            return $this->redirect('index/index');
        }else{
            return $this->fetch();
        }
        
    }

    public function check()
    {
        if (request()->isPost()) {
            $data = input('post.');
            if (!captcha_check($data['code'])) {
                $this->error('验证码错误!');
            }
            //判定username password
            $validate = validate('Login');
            if (!$validate->check($data)) {
                $this->error($validate->geterror());
            }
            
            try {
                $res = AdminUser::get(['username'=>$data['username']]);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }

            if (!$res || $res['status'] != config('code.status_normal')) {
                $this->error('该用户不存在!');
            }
            if (IAuth::setPwd($data['password']) != $res['password']) {
                $this->error('密码不正确!');
            }
            $udata = [
                    'last_login_time' => time(),
                    'last_login_ip' => request()->ip(),
                ];
            try {
                AdminUser::update($udata, ['id' => $res['id']]);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
            }
            //session
            session(config('admin.session_user'), $res, config('admin.session_user_scope'));
            $this->success('登录成功', 'index/index');
        } else {
            $this->error('请求不合法!');
        }
    }

    /**
     * 退出登录
     * 1.清空session
     * 2.跳转到登录页面
     */
    public function logout()
    {
        session(null, config('admin.session_user_scope'));
        $this->redirect('login/index');
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        //
    }
}
