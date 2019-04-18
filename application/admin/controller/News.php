<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\News as MewsModel;

class News extends Base
{
    public function index()
    {
        $data = input('param.');
        //获取数据,填充到模版
        //模式一
        // $news = model('News')->getNews();
        //模式二 page size from --> limit from size
        $whereData['page'] = !empty($data['page'])?$data['page']:1;
        $whereData['size'] = !empty($data['size'])?$data['size']:config('pagination.list_rows');
        $news = model('News')->getNewsByCondition($whereData);
        return $this->fetch('', [
            'news'=>$news,
        ]);
    }

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
                return $this->result(['jump_url'=>url('news/index')], 1, '新增成功');
            } else {
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
}
