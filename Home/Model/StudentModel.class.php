<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/16
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class StudentModel extends Model{
    /**
     * 通过学生ID查找学生
     * @param $student_id 学生ID
     * @return mixed 返回学生信息
     */
    function selectStuById($student_id){
        $res=$this->where("id=".$student_id)->select();
        return $res[0];
    }

    function getStudentInfo($userId){
        $map['id'] = $userId;
        $re = $this->where($map)
                ->join('jf_school ON jf_school.id = jf_student.school_id')
                ->join('jf_takes ON jf_takes.student_id = jf_student.id')
                ->field('jf_takes.course_id,jf_school.name,jf_student.stu_number')
                ->find();
        if($re){
            return false;
        }else{
            return $re;
        }
    }


}