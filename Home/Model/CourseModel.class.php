<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/1/16
 * Time: 17:21
 */
namespace Home\Model;
use Think\Model;

class CourseModel extends Model{
    function showCourse(){
        $instructor_id=$_SESSION["user"]["id"];
        $model=new Model();
        $sql="select from jf_teaches as t,jf_course as c,jf_time_solt as s where t.instructor= $instructor_id and t.course_id=c.id and s.time_solt_id=c.time_solt_id";
        $res=$model->query($sql);
        return $res;
    }

    /**
     * 展示该课程所有学生信息
     *
     * @param $course_id 课程的ID
     * @return mixed 返回所有学生信息
     */
    function showStudent($course_id){
        $takes=D("takes");
        $student_id=$takes->where("course_id=".$course_id)->select();
        //因为多个学生
        $student=new StudentModel();
        for($i=0;$i<count($student_id);$i++){
            $students[$i]=$student->selectStuById($student_id['student_id']);
        }
        return $students;
    }

    /**
     * 开始点名
     *
     * @param $course_id 课程ID
     * @return mixed
     */
    function endCheck($course_id,$check_time){
        $checkroll_from=D("CheckrollFrom");
        $checkroll_from->check_date=$check_time;
        $checkroll_from->end_time=time();
        $checkroll_from->course_id=$course_id;
        $res=$checkroll_from->add();
        if(!$res){
            return false;
        }
    }

    /**
     * 通过course_id 搜索课程
     *
     * @param $course_id 课程id
     * @return mixed
     */
    function searchCourse($course_id){
        //要知道上课时间
        $res=$this->where("id=".$course_id)->select();
        //得到了上课时间time_solt_id
        $res=$this->addTime($res);
        return $res;
    }

    /**
     * 为课程插上时间
     * @param $course 课程信息
     * @return mixed 返回插上时间信息的课程id
     */
    function addTime($course){
        $time_solt=D("TimeSolt");
        $time_info=$time_solt->where("time_solt_id=".$course[0]["time_solt_id"])->select();
        //为$res 附上时间信息
        $course[0]['year']=$time_info[0]['year'];
        $course[0]['semester']=$time_info[0]['semester'];
        $course[0]['day']=$time_info[0]['day'];
        $course[0]['start_time']=$time_info[0]['start_time'];
        return $course;
    }




}