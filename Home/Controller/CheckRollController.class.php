<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Home\Model\CheckrollReplyModel;
use Home\Model\CourseModel;
use Home\Model\StudentModel;
use Think\Controller;
define("QIANDAO",0);
define("SHIJIA",1);
define("BINGJIA",2);
class CheckRollController extends Controller {
    /**
     * 首页展示教师所有课程
     *
     */
    public function index(){
        $course=new CourseModel();
        $res=$course->showCourse();
    }

    /**
     * 根据课程展示学生
     */
    function showStudent(){
        //课程ID
        $course_id=$_GET['course_id'];
        $course=new CourseModel();
        $students=$course->showStudent($course_id);
        $this->assign("students",$students);
        $this->display();
    }

    /**
     * 记录开始点名时间
     */
    function startCheck(){
        $_SESSION['USER']['STARTCHECK']=time();
    }


    /**
     * 点名结束时，处理非到人员
     *
     * 记录开始点名时间，记录非到人员，前端name=student_id[]   name=reply[]  一一对应
     */
    function endCheck(){
        $course=new CourseModel();
        $course_id=$_POST['course_id'];
        $res=$course->endCheck($course_id,$_SESSION['USER']['STARTCHECK']);
        if(!res){
            $this->error("操作错误");
        }
        //获取所有事假或病假信息，要一一对应
        $checkroll_reply=new CheckrollReplyModel();
        $student_id=$_POST["student_id"];
        $reply=$_POST["reply"];
        for($i=0;$i<count($reply);$i++){
            $j=$i;
            if($reply[$i]!=QIANDAO){
                $ress=$checkroll_reply->addCheckReply($student_id[$j],$res,$reply[$i]);
                if(!$ress){
                    $this->error("操作错误");
                }
            }
        }
    }
    /**
     * 查看点名结果前展示教师所有课程提供选择
     *
     */
    function checkIndex(){
        $course=new CourseModel();
        $res=$course->showCourse();
    }

    function checkResult(){
        $course_id=$_POST['course_id'];
        $checkroll_fr_id=$_POST['checkroll_fr_id'];
        //课程信息
        $course=new CourseModel();
        $course_info=$course->searchCourse($course_id);
        $checkroll_reply=new CheckrollReplyModel();
        $check_time=$checkroll_reply->searchCheckTime($checkroll_fr_id);

        //请假的人数
        $leave=$checkroll_reply->searchLeave($checkroll_fr_id);
        $leave_num=count($leave);
        //事假人数
        $shijia_num=0;
        for($i=0;count($leave);$i++){
            if($leave[$i]['status']==SHIJIA){
                $shijia_num++;
            }
        }
        //病假人数
        $bingjia_num=$leave_num-$shijia_num;

        //请假人具体信息
        $student=new StudentModel();
        for($i=0;$i<count($leave);$i++){
            $student_info[$i]=$student->selectStuById($leave[$i]["student_id"]);
        }
    }

    /**
     * 课堂提问主页
     */
    function askQuestion(){
        //首先知道是哪一节课
        $course_id=$_GET["course_id"];
        //获取课程信息
        $course=new CourseModel();
        $course_info=$course->searchCourse($course_id);
        //通过course_id 获取所有学生名单
        $student=$course->showStudent($course_id);
    }

    function insertAskQuestion(){
        //点击个人后 ajax 创建 数据库提问记录
        $course_id=$_GET["course_id"];
        $clquestion_from=D("ClquestionFrom");
        $clquestion_from->course_id=$course_id;
        $clquestion_from->date=time();
        //返回记录id
        $clquestion_id=$clquestion_from->add();
        if($clquestion_id){
            //记录这个id 评分时利用
            $_SESSION["user"]["ask_question"]=$clquestion_id;
            echo 1;
        }else {
            echo 0;
        }
    }

    function answerEval(){
        //课程信息  学生信息
        //首先知道是哪一节课
        $course_id=$_GET["course_id"];
        //获取课程信息
        $course=new CourseModel();
        $course_info=$course->searchCourse($course_id);
        //通过course_id 获取所有学生名单
        $student=$course->showStudent($course_id);

        //依然利用ajax 评分
        //获取学生id
        $student_id=$_GET["student_id"];
        //问题id
        $clquestion_id=$_SESSION["user"]["ask_question"];
        $score=$_GET["score"];
        //insert评分时间
        $clquestion_answer=D("ClquestionAnswer");
        $clquestion_answer->student_id=$student_id;
        $clquestion_answer->score=$score;
        $clquestion_answer->clquestion_id=$clquestion_id;
        $res=$clquestion_answer->add();
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }




}