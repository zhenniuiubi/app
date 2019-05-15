<?php

namespace app\api\controller;

use app\api\controller\Common;

class Index extends Common
{
    /**
     * 客户端初始化接口
     * 1. 检测APP是否需要升级
     */
    public function init()
    {
        // $version = model('Version')->getLastVersionByAppType($this->headers['app_type']);
        $version = model('Version')->getLastVersionByAppType('android');
        if (!$version) {
            return;
        }
        if ($version['version'] > 4) {
            $version['is_update'] = $version['force'] == 1?2:1;
        } else {
            $version['is_update'] = 0; //0 不更新 1 更新 2 强制更新
        }
        return show(config('code.success'), 'OK', $version, 200);
    }
    /**
     * 获取首页接口
     * 1. 头图 4-6
     * 2/ 推荐位列表 默认40条
     */
    public function index()
    {
        $header =  model('News')->getIndexHeadNormalNews();
        $heads = $this->getDealNews($header);
        $positions = model('News')->getPositionNormalNews();
        $positions = $this->getDealNews($positions);

        $result = [
            'heads' => $heads,
            'positions' => $positions,
        ];
        return show(config('code.success'), 'OK', $result, 200);
    }
}
