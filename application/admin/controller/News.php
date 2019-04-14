<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\News as MewsModel;

class News extends Base
{
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            //数据校验 待写
            //入库操作
            try {
                $news = MewsModel::create($data);
            } catch (\Exception $e) {
                return $this->result(['',0,'新增失败']);
            }
            if ($news->id) {
                return $this->result(['jump_url'=>url('news/index')],1,'新增成功');
            }else{
                return $this->result(['',0,'新增失败']);
            }
        } else {
            return $this->fetch('', [
                'cats' => config('cat.list'),
            ]);
        }
    }

    public function uploadify()
    {
        return $this->fetch();
    }
    
    public function index()
    {
        echo 1111111111;
    }
}
