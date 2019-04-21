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
    public $model = '';
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

    /**
     * 删除逻辑
     */
    public function delete($id=0)
    {
        if (!intval($id)) {
            return $this->result('',0,'id不合法!');
        };
        $model = $this->model?$this->model:request()->controller();
        try {
            $res = model($model)->save(['status'=>-1],['id'=>$id]);
        } catch (\Exception $e) {
            return $this->result('',0,$e->getMessage());
        }
        if ($res) {
            return $this->result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'删除成功');
        }
        return $this->result('',0,'删除失败');
    }

    /**
     * 通用状态修改
     */
    function status()
    {
        $data = input('param.');
        // halt($data);
        if (!intval($data['id'])) {
            return $this->result('',0,'id不合法!');
        };
        $model = $this->model?$this->model:request()->controller();
        try {
            $res = model($model)->save(['status'=>$data['status']],['id'=>$data['id']]);
        } catch (\Exception $e) {
            return $this->result('',0,$e->getMessage());
        }
        if ($res) {
            return $this->result(['jump_url'=>$_SERVER['HTTP_REFERER']],1,'修改成功');
        }
        return $this->result('',0,'修改失败');
    }
}
