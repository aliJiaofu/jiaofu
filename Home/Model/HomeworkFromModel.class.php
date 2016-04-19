<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/16
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class HomeworkFromModel extends Model{
    function showHomework($course_id){
        //通过课程id获取所有作业
        $res=$this->where("course_id=$course_id")->select();
        //转换时间
        $common=new CommonModel();
        for($i=0;$i<count($res);$i++){
            $res[$i]["homework_time"]=$common->changeTime($res[$i]["homework_time"]);
            $res[$i]["homework_deadline"]=$common->changeTime($res[$i]["homework_deadline"]);
        }
        $homework_submit=D("HomeworkSubmit");

        //已经提交的人数
        for($i=0;$i<count($res);$i++){
            $num=$homework_submit->where("homework_fr_id=".$res[$i]['homework_fr_id'])->count();
            $res[$i]["finish_num"]=$num;
        }
        return $res;
    }


}