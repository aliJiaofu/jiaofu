<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-15
 * Time: 下午2:45
 */

namespace Home\Controller;

use Think\Controller;
class CourseController extends Controller{
    /**
     * 创建课程首页
     *
     *遍历出学年 上课week（checkout 可写死） 时间（待定）（是否也应该为checkout 可写死）
     */
    public function index(){
        $start_year=2015;
        $end_year=2016;
        $year_arr=array();
        for($i=0;$i<=10;$i++){
            $year_arr[$i]=$start_year."--".$end_year;
            $start_year++;
            $end_year++;
        }
        $week_arr=array('星期一','星期二','星期三','星期四','星期五','星期六','星期日');
        $time_arr=array();
        $time=8;
        for($i=0;$i<14;$i++){
            $time_arr[$i]=$time.":00";
            $time++;
        }
        $this->assign('time',$time_arr);
        $this->assign('week',$week_arr);
        $this->assign('year',$year_arr);
        $this->display();
    }
    /**
     * 上传 有学生信息的excel
     *
     * @return mixed|string
     */
    //上传学生信息excel表单
    public function upload_stu_excel(){
        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'     =>    './Public/tmp/',
            'savePath'   =>    '',
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('xlsx'),
            'autoSub'    =>false,
            'replace'       =>  true,
        );
        $upload = new \Think\Upload($config);// 实例化上传类
        // 上传单个文件
        $info   =   $upload->uploadOne($_FILES['stu_excel']);

        if(!$info) {// 上传错误提示错误信息
            return $upload->getError();
        }else{// 上传成功 获取上传文件信息
            return $this->read_excel($info['savename']);
        }

    }
    /**
     * @param $file_name
     * @return mixed|string
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     */
    //读取上传的excel
    public function read_excel($file_name){
        //导入PHP处理 Excel的文件
        import("Org.Util.PHPExcel");
        $filename_arr=explode('.', $file_name);
        $filename="./Public/tmp/".$file_name;
        $PHPExcel=new \PHPExcel();
        import("Org.Util.PHPExcel.Reader.Excel2007");
        $PHPReader=new \PHPExcel_Reader_Excel2007();
        //载入文件
        $PHPExcel=$PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet=$PHPExcel->getSheet(0);
        //获取总列数
        $allColumn=$currentSheet->getHighestColumn();
        //获取总行数
        $allRow=$currentSheet->getHighestRow();
        //提取相应的索引以及有效信息的行
        $err_mess='';
        $avail=array('stu_number','name');
        for($currentRow=1;$currentRow<=$allRow;$currentRow++){
            for($currentColumn='A';$currentColumn<=$allColumn;$currentColumn++){
                $address=$currentColumn.$currentRow;
                $arr_val=$currentSheet->getCell($address)->getValue();
                if($currentRow==1){
                    $first_row=$arr_val;
                    if($first_row!='学号'){
                        $err_mess=$first_row;
                        break;
                    }
                    continue;
                }else{
                    if($arr_val!=''){
                        $i=$currentColumn=='A'?0:1;
                        $new_arr[$currentRow-2][$avail[$i]]=$arr_val;
                    }else{
                        continue;
                    }
                }
            }
        }
        //删除文件
        unlink('/var/www/html/jf_system/Public/tmp/'.$file_name);
        if($err_mess!=''){
            return $err_mess;
        }else{
            return $new_arr;
        }

    }
    //插入数据到takes表
    public function add_takes($stu_id,$course_id){
        $ta=M('takes');
        $ta_data['student_id']=$stu_id;
        $ta_data['course_id']=$course_id;
        $take=$ta->where($ta_data)->find();
        if(!$take){

            $ta->add($ta_data);
        }
    }
    /**
     * 把刚添加的课程加入course表
     *
     * @return string
     */
    //生成课程号
    public function create_cornum(){
        $co=M('course');
        $conum='';
        for($i=0;$i<6;$i++){
            $conum.=rand(0,9);
        }
        $cor_where['course_num']=$conum;
        $cor=$co->where($cor_where)->find();
        if($cor){
            $this->create_cornum();
        }else{
            return $conum;
        }
    }
    /**
     * 创建课程入口
     *
     * 读取excel 插入数据库；上课时间插入time_solt,teaches,course
     */
    //创建课程
    public function create_course(){
        if(!isset($_SESSION)){
            $this->redirect('Index/login');
        }
        //上传-->用数组stu_excel保存excel所有的信息
        $stu_excel=$this->upload_stu_excel();
        if(!is_array($stu_excel)){
            echo "{\"message\":\"上传失败！$stu_excel\"}";
        }
        else{
        //导入课程--处理time_solt,teaches,course
        $ti=M('time_solt');

        $ti_data['year']=$_POST['year'];
        $ti_data['semester']=$_POST['semester'];
        $ti_data['day']=$_POST['date'];
        $ti_data['start_time']=$_POST['start_time'];
        $time=$ti->where($ti_data)->find();
        if($time){
            //如果已经有相同时间，则只要记录这个id
            $time_solt_id=$time['time_solt_id'];
        }else{
            $time_solt_id=$ti->add($ti_data);
        }
        //获取到上课时间ID后 处理course
        $co=M('course');
        $co_data['time_solt_id']=$time_solt_id;
        $co_data['cor_address']=$_POST['cor_address'];
        $co_data['create_time']=time();
        $co_data['name']=$_POST['course_name'];
        //生成课程号
        $co_num=$this->create_cornum();
        $co_data['course_num']=$co_num;
        @mkdir('/var/www/html/jf_system/Public/course/'.$co_num,0777);
        //学生人数尚未插入

        $course_id=$co->add($co_data);
        //处理teaches表
        $tea=M('teaches');
        $te_data['instructor_id']=$_SESSION['user']['instructor_id'];
        $te_data['course_id']=$course_id;
        $tea->add($te_data);

        //导入课程--处理学生信息excel($stu_excel)
        $st=M('student');
        $de=M('stu_default');
        for($i=0;$i<count($stu_excel);$i++){
            //检查信息是否有重复
            //查看student表中改学生是否已经注册过
            $st_data['school_id']=$_SESSION["user"]['school_id'];
            $st_data['name']=$stu_excel[$i]['name'];
            $st_data['stu_number']=$stu_excel[$i]['stu_number'];
            $stu=$st->where($st_data)->find();

            if($stu){
                //如果已经被其他老师导入过，并且还没有激活，则添加新的登录密码,并且给该学生takes表添加新课
                if($stu['status']==0){
                    $de_where['student_id']=$stu['id'];
                    $def=$de->where($de_where)->find();
                    $def['course_num'].='-'.$co_num;
                    $de->where($de_where)->setField($def);
                }
                $this->add_takes($stu['id'],$course_id);
            }else{
                //如果没有被导入过,则处理student表，添加姓名 学号 学校ID
                $st_data['status']=0;
                //获得新添加的student的id
                $student_id=$st->add($st_data);
                //处理takes表
                $ta_data['student_id']=$student_id;
                $ta_data['course_id']=$course_id;
                $this->add_takes($student_id,$course_id);
                //处理student_default 添加新的登录密码
                $de_data['student_id']=$student_id;
                $de_data['course_num']=$co_num;
                $de->add($de_data);
            }
        }
            echo "{\"message\":\"上传成功！\"}";
        }
    }
    /**
     * 展示教师带的所有课程
     */
    //教师查看课程
    public function cor_browse(){
        $te=M('teaches');
//        $in=M('instructor');
//        $in_where['id']=$_SESSION["user"]['institute_id'];
//        $instructor=$in->where($in_where)->find();
        //根据teacher id搜出所有teaches
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
//        $this->assign('ins_name',$instructor['real_name']);
        $this->assign('teaches',$teaches);
        $this->display();
    }


    //课程删除
    public function delete(){
        $co=M('course');
        $ta=M('takes');
        $te=M('teaches');
        $co_where['id']=$_GET['id'];
        $ta_where['course_id']=$_GET['id'];
        $cour=$co->where($co_where)->find();
        @unlink('/var/www/html/jf_system/Public/course/'.$cour['course_num']);
        $ta->where($ta_where)->delete();
        $co->where($co_where)->delete();
        $te->where($ta_where)->delete();
        $this->redirect('Course/cor_browse');
    }
    //课程信息修改
}