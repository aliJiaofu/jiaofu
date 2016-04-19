<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-21
 * Time: 下午5:49
 */

namespace Home\Controller;
use Think\Controller;

class StudentController extends Controller{
    /**
     *
     */
    public function index(){
        if(!isset($_SESSION["user"])){
            $this->redirect('Index/login');
        }
        $de=M('department');
        $school=D("school");
        $school->where("id=".$_SESSION["user"]["school_id"])->select();
        $de_where['school_id']=$_SESSION["user"]['id'];
        $de_where['dept_id']=$_SESSION["user"]['dept_id'];
        $depart=$de->where($de_where)->select();
        $this->assign('depart',$depart);
//        $this->assign('stu_name',$_SESSION['stu_name']);
//        $this->assign('stu_status',$_SESSION['stu_status']);
        $this->display();
    }

    public function check_login(){
        $st=M('student');
        $where['email']=$_POST['email'];
        $where['password']=md5($_POST['password']);
        $student=$st->where($where)->find();
        if($student){
            echo'success';
            $_SESSION['stu_id']=$student['id'];
            $_SESSION['stu_schoolid']=$student['school_id'];
            $_SESSION['stu_name']=$student['name'];
            $_SESSION['stu_status']=$student['status'];
        }else{
            echo 'fail';
            return false;
        }
    }

    /**
     * 学生没验证，第一次登录
     */
    public function first_login(){
        //遍历出所有学校
        $sc=M('school');
        $school=$sc->select();
        $this->assign('school',$school);
        $this->display();
    }

    public function check_firstlogin(){
        //获取学校id 学号
        $st=M('student');
        $st_data['school_id']=$_POST['school_id'];
        $st_data['name']=$_POST['name'];
        $st_data['stu_number']=$_POST['stu_number'];
        $student=$st->where($st_data)->find();
        if($student){
            if($student['status']!=0){
                echo '您的账号已激活，请使用账号密码登陆';
                return false;
            }
            //验证输入的验证码是否正确
            $sde=M('stu_default');
            $sde_data['student_id']=$student['id'];
            $sdefault=$sde->where($sde_data)->find();
            $sde_arr=explode('-',$sdefault['course_num']);
            if(in_array($_POST['default'],$sde_arr)){
//                $_SESSION['stu_id']=$student['id'];
//                $_SESSION['stu_schoolid']=$student['school_id'];
//                $_SESSION['stu_name']=$student['name'];
//                $_SESSION['stu_status']=$student['status'];
                  $_SESSION['user']=$student;
                echo 'success';
            }else{
                echo '初始密码错误，请重新填写';
            }

        }else{
            echo '相关信息错误，请重新填写';
        }
    }

    /**
     * 补充信息
     *
     * 邮箱 登录密码
     * @return bool
     */
    public function modify_info(){
        $st=M('student');
        $email_whrere['email']=$_POST['email'];
        $stu_email=$st->where($email_whrere)->find();
        if($stu_email){
            echo 'existed_email';
            return false;
        }
        $st_where['id']=$_SESSION["user"]['id'];
//        $st_data['dept_id']=$_POST['dept_id'];
//        $st_data['major_name']=$_POST['major_name'];
//        $st_data['grade']=$_POST['grade'];
//        $st_data['sex']=$_POST['sex'];
        $st_data['email']=$_POST['email'];
        $st_data['password']=md5($_POST['password']);
        $st_data['status']=1;
        $stu=$st->where($st_where)->setField($st_data);
        if($stu){
            $_SESSION['stu_status']=1;
            echo $_SESSION['stu_status'];
        }
    }

    /**
     * 学生查看课程
     */
    //学生课程信息
    public function mycourse(){
        if(!isset($_SESSION["user"])||$_SESSION["user"]['status']!=1){
            $this->redirect('/Index/login');
        }
        $ta=M('takes');
        $co=M('course');
        $ti=M('time_solt');
        //takes上搜学生上的课程 id
        $ta_where['student_id']=$_SESSION['user']['id'];
        $takes=$ta->where($ta_where)->select();
        for($i=0;$i<count($takes);$i++){
            $co_where['id']=$takes[$i]['course_id'];
            //通过课程id搜索所有课程信息
            $course=$co->where($co_where)->find();
            //记录前端需要展示的信息 课程名称 课程时间 课程号 上课地点 课程建立时间（待定）
            $takes[$i]['course_name']=$course['name'];
            $ti_where['id']=$course['time_solt_id'];
            $time=$ti->where($ti_where)->find();
            $takes[$i]['course_time']=$time['year'].'学年度-第'.$time['semester'].'学期-'.$time['day'].'-'.$time['start_time'];
            $takes[$i]['course_num']=$course['course_num'];
            $takes[$i]['course_address']=$course['cor_address'];
            $takes[$i]['create_time']=$course['create_time'];
//            $takes[$i]['course_name']=$course['name'];
        }
        $this->assign('stu_name',$_SESSION['stu_name']);
        $this->assign('takes',$takes);
        $this->display();
    }
}