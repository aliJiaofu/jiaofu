<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/16
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class CommonModel extends Model{
    /**
     * 把时间戳转换成可视化时间
     *
     * @param $time 时间戳
     * @return bool|string 可视化时间
     */
    function changeTime($time){
        $data=date('Y-m-d H:i:s',$time);
        return $data;
    }


}