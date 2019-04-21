<?php
namespace app\admin\controller;

use app\admin\controller\Base;
use app\admin\model\News as MewsModel;

class News extends Base
{
    public function index()
    {
        $data = input('param.');
        $query = http_build_query($data);
        $whereData = [];
        if (!empty($data['start_time']) && !empty($data['end_time']) && $data['end_time'] > $data['start_time']) {
            $whereData['create_time'] = [
                ['gt', strtotime($data['start_time'])],
                ['lt', strtotime($data['end_time'])],
            ];
        }
        if (!empty($data['catid'])) {
            $whereData['catid'] = intval($data['catid']);
        }
        if (!empty($data['title'])) {
            $whereData['title'] = ['like','%'.$data['title'].'%'];
        }
        //模式一
        $news = model('News')->getNews();
        //模式二 page size from --> limit from size
        $this->getPageAndSize($data);
        

        $news = model('News')->getNewsByCondition($whereData,$this->from,$this->size);
        $totle = model('News')->getNewsCountByCondition($whereData);
        //总页数
        $pageTotal = ceil($totle/$this->size);
        return $this->fetch('', [
            'cats'=>config('cat.list'),
            'news'=>$news,
            'pageTotal'=>$pageTotal,
            'curr'=>$this->page,
            'start_time'=>empty($data['start_time'])?'':$data['start_time'],
            'end_time'=>empty($data['end_time'])?'':$data['end_time'],
            'catid'=>empty($data['catid'])?'':$data['catid'],
            'title'=>empty($data['title'])?'':$data['title'],
            'query'=>$query
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
}
