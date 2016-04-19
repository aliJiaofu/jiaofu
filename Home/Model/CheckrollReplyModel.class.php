<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/16
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class CheckrollReplyModel extends Model{
    /**
     * 记录非到人员
     *
     * @param $student_id 学生ID
     * @param $checkroll_fr_id 开始点名时间
     * @param $status 状态，事假=1，旷课=2
     * @return bool 失败返回false
     */
    function addCheckReply($student_id,$checkroll_fr_id,$status){
        $this->checkroll_fr_id=$checkroll_fr_id;
        $this->student_id=$student_id;
        //check_id是什么
        $this->check_id=1;
        $this->date=time();
        $this->status=$status;
        $res=$this->add();
        if(!$res){
            return false;
        }
    }

    function searchCheckTime($checkroll_fr_id){
        $checkroll_from=D("CheckrollFrom");
        $res=$checkroll_from->where("checkroll_fr_id=".$checkroll_fr_id)->select();
        return $res;
    }

    function searchLeave($checkroll_fr_id){
        $res=$this->where("checkroll_fr_id=".$checkroll_fr_id)->select();
        return $res;
    }

}