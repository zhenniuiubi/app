<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function pagination($obj)
{
    if (!$obj) {
        return '';
    }
    $params = request()->param();
    return '<div class="imooc-app">'.$obj->appends($params)->render().'</div>';
}

/**
 * 获取栏目名称
 */
function getCatName($catId)
{
    if (!$catId) {
        return '';
    }
    $cats = config('cat.list');
    return !empty($cats[$catId]) ? $cats[$catId] : '';
}

/**
 * 状态
 */
function status($id, $status)
{
    $condition = request()->controller();
    $sta = $status == 1?0:1;
    // halt($status);
    $url = url($condition.'/status', ['id'=>$id,'status'=>$sta]);
    if ($sta==1) {
        $str = "<a href='javascript:;' title='修改状态' status_url='".$url."'onclick='app_status(this)'><span class='label labe-success radius'>正常</span></a>";
    } elseif ($sta==0) {
        $str = "<a href='javascript:;' title='修改状态' status_url='".$url."'onclick='app_status(this)'><span class='label labe-danger radius'>待审</span></a>";
    }
    return $str;
}

function show($status,$message,$data=[],$httpCode=200)
{
    $data = [
        'status' => $status,
        'message' => $message,
        'data' => $data,
    ];
    return json($data,$httpCode);
}