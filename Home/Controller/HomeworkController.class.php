<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-23
 * Time: 上午10:17
 */
namespace Home\Controller;

use Home\Model\CourseModel;
use Home\Model\HomeworkFromModel;
use Home\Model\StudentModel;
use Think\Controller;
class HomeworkController extends Controller{
    /**
     * 有许多课程 可布置作业
     */
    public function __initialize(){
        header("Content-Type: text/html; charset=utf-8");
    }
    public function index(){
        if(!isset($_SESSION['ins_id'])){
            $this->redirect('Index/login');
        }
        //把所有课程遍历出来的function
        $this->cor_browse();
        $this->display();
    }

    /**
     * 展示教师带的所有课程
     */
    //教师查看课程
    public function cor_browse(){
        $te=M('teaches');
//        $in=M('instructor');
//        $in_where['id']=$_SESSION['ins_id'];
//        $instructor=$in->where($in_where)->find();
        $te_where['instructor_id']=$_SESSION["user"]['id'];
        $teaches=$te->where($te_where)->select();
        $co=M('course');
        $ti=M('time_solt');
        for($i=0;$i<count($teaches);$i++){
            //根据course_id 搜course表
            $co_where['id']=$teaches[$i]['course_id'];
            $course=$co->where($co_where)->find();
            //根据course表的 time_solt_id 搜出 上课时间
            $ti_where['id']=$course['time_solt_id'];
            $time=$ti->where($ti_where)->find();
            $teaches[$i]['course_time']=$time['year'].'学年度-第'.$time['semester'].'学期-'.$time['day'].'-'.$time['start_time'];
            $teaches[$i]['course_num']=$course['course_num'];
            $teaches[$i]['course_address']=$course['cor_address'];
            $teaches[$i]['create_time']=$course['create_time'];
            $teaches[$i]['course_name']=$course['name'];
        }
        $this->assign('teaches',$teaches);
    }

    /**
     * 布置作业主页
     *
     *遍历所有已经布置过的作业
     */
    public function homework_release(){
        $co=M('course');
        $co_where['course_num']=$_GET['course_num'];
        $cour=$co->where($co_where)->find();
        if(!$cour){
            $this->redirect('Homework/index');
        }else{
            $te=M('teaches');
            $te_where['instructor_id']=$_SESSION["user"]['id'];
            $te_where['course_id']=$cour['id'];
            $tea=$te->where($te_where)->find();
            if(!$tea||!isset($_SESSION['user'])){
                $this->redirect('Homework/index');
            }else{
                $ti=M('time_solt');
                $ti_where['time_solt_id']=$cour['time_solt_id'];
                $time=$ti->where($ti_where)->find();
                $cour['time']=$time['year']."学年度-第".$time['semester']."学期";
                //找到所有布置过的作业
                $hf=M('homework_from');
                $hf_where['course_id']=$cour['id'];
                $how_from=$hf->where($hf_where)->select();
            }
            $this->assign('how_from',$how_from);
            $this->assign('course',$cour);
            $this->display();
        }
    }

    /**
     * 发布作业操作
     *
     * 记录作业 homework_from
     */
    public function do_release(){
        $hr=M('homework_from');
        $info_arr=explode('+',$_POST['course_id']);
        $hr_data['course_id']=$info_arr[0];
        $hr_data['homework_name']=$_POST['homework_name'];
        $hr_data['homework_detail']=$_POST['homework_detail'];
        $hr_data['homework_deadline']=$_POST['year'].'年'.$_POST['month'].'月'.$_POST['day'].'号';
        $hr_data['create_time']=date('Y-m-d H:i:s');
        $hfrom=$hr->add($hr_data);
        if($hfrom){
            @mkdir('/var/www/html/jf_system/Public/course/'.$info_arr[1].'/'.$_POST['homework_name'].$hfrom);
            $this->redirect('Homework/homework_release?course_num='.$info_arr[1]);
        }
    }

    /**
     * 遍历课程所有的作业
     */
    function homeworkList(){
        $course=new CourseModel();
        //通过用户id搜出他所有的课程
        $all_course=$course->searchCourse();
        //首先知道是哪一节课
        $course_id=$_GET["course_id"];
        //获取课程信息
        $course_info=$course->searchCourse($course_id);
        //获取该课程的作业列表
        $homework_from=new HomeworkFromModel();
        $homework=$homework_from->showHomework($course_id);
    }

    /*
     * 上传作业
     * */
    public function uploadHomework(){
        /*$userId = $_SESSION["user"]['id']; //学生id

        $student = new StudentModel();
        $studentInfo = $student->getStudentInfo($userId);

        //文件结构 ./学校名/课程id/学生学号/上传名
        //返回文件上传路径
        $url = $this->upload($studentInfo['school_name'],$studentInfo['course_id'],$studentInfo['stu_number']);
        */
        $url = $this->upload();
        /*
         * todo 做存数据库操作*/
        $homework = new HomeworkFromModel();
        /*
         * todo 取数据库操作时需要将$url['root_path']做编码操作*/

        $url['root_path'] = base64_encode($url['root_path']);
        $this->assign('url',$url);
        $this->display('uploadHomeworks');
    }
    public function upload($course = '123',$stuNum = '20141002496')
    {
        //Todo 中文路径会有乱码，还没解决

        if (!file_exists('./Public/upload/homework/'.$course)) {
            mkdir ("./Public/upload/homework/".$course);
        }
        if (!file_exists('./Public/upload/homework/'.$course.'/'.$stuNum)) {
            mkdir ("./Public/upload/homework/".$course.'/'.$stuNum);
        }

//        var_dump($_FILES['homework']['name']);
        import("@.ORG.UploadFile");

        $_FILES['homework']['name'] = iconv("utf-8","gb2312",$_FILES['homework']['name']); //把中文文件名已utf-8的形式存储，防乱码
        $config = array(
            'rootPath' => './public/', //保存根路径
            'savePath' => 'upload/homework/'.$course.'/'.$stuNum.'/', //保存路径
            'saveName' => '',
            'replace' => true,        //存在同名文件覆盖
            'autoSub'  => false,
        );
        $upload = new \Think\Upload($config);

        $info = $upload->upload($_FILES);
        if (!$info) {// 上传错误提示错误信息
            return $upload->getError();
        } else {// 上传成功 获取上传文件信息
            $url['root_path'] = 'Public/'.$info['homework']['savepath'];
            $url['file'] = iconv("utf-8","gb2312",$info['homework']['savename']);
            return $url;
        }
    }
    public function download($rootPath,$file){
        header("Content-type:text/html;charset=utf-8");

        //用以解决中文不能显示出来的问题
        $fileName=iconv("utf-8","gb2312",$file);//文件名
//        $rootPath="./Public/upload/homework/123/20141002496/";
        $filePath=base64_decode($rootPath).$fileName;
        var_dump($filePath);
        //首先要判断给定的文件存在与否
        if(!file_exists($filePath)){
            echo "没有该文件文件";
            return ;
        }
        $fp=fopen($filePath,"r");
        $file_size=filesize($filePath);
        //下载文件需要用到的头
        Header("Content-type: application/octet-stream");
        Header("Accept-Ranges: bytes");
        Header("Accept-Length:".$file_size);
        Header("Content-Disposition: attachment; filename=".$fileName);
        $buffer=1024;
        $fileCount=0;
        //向浏览器返回数据
        while(!feof($fp) && $fileCount<$file_size){
            $fileCon=fread($fp,$buffer);
            $fileCount+=$buffer;
            echo $fileCon;
        }
        fclose($fp);
    }

}
