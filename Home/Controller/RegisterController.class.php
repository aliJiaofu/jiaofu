<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16-1-12
 * Time: 下午1:14
 */

namespace Home\Controller;
use Think\Controller;
define("MALE",1);
define("FEMALE",2);
class RegisterController extends Controller{
    /**
     * 注册页面
     *
     * 遍历出所有学校信息 供选择
     */
    public function index(){
        $sch=M('school');
        $sh=$sch->select();
        $this->assign('school',$sh);
        $this->display();
    }
    /**
     * 遍历出所有学院信息
     *
     * ajax：选择完学院后遍历出所有学院
     */
    //获取学院
    public function get_dept(){
        if($_GET['school']){
            $sch=M('school');
            $where['name']=$_GET['school'];
            $sh=$sch->where($where)->find();
            $dep=M('department');
            $where1['id']=$sh['id'];
            $dept= $dep->where($where1)->select();
            echo json_encode($dept);
        }
    }

    /**
     * ajax 生成验证码 发送到目标邮箱
     *
     * 邮箱要以 edu.cn 结尾 否则返回false
     * @return bool
     */
    //获取验证码
    public function getcode(){
        $email=$_POST['email'];
        $email_arr=explode('.', $email);
        $em_suffix=$email_arr[count($email_arr)-2].'.'.$email_arr[count($email_arr)-1];
        $suffix=array('edu.cn');
        if(!in_array($em_suffix,$suffix)){
            echo 'err_email';
            return false;
        }
        $title="教辅系统验证码";
        $arr=array();
        for($i=0;$i<6;$i++){
            $arr[$i]=rand(0,9);
        }
        $content='';
        for($i=0;$i<count($arr);$i++){
            $content.=$arr[$i];
        }

        $_SESSION['code']=$content;
        //$title 邮箱标题
        //$content 是发送邮箱的信息，可以重新编辑

        if(SendMail($_POST['email'],$title,$content)){
            echo 'success';
        }
        else{echo 'fail';}
    }
    /**
     * ajax 邮箱查重复
     *
     * 先检查邮箱是否重复，再获取验证码，发送邮箱
     */
    //检查邮箱
    public function check_email(){
        $ins=M('instructor');
        $where['email']=$_GET['email'];
        $in=$ins->where($where)->find();
        if($in['email']){
            echo'1';
        }
    }

    /**
     *ajax 验证 验证码
     */
    //检查验证码
    public function check_verify(){
        if($_SESSION['code']==$_GET['code']){
            echo 1;
        }
    }
    /**
     * 点击注册 数据库添加用户
     *
     * @return bool
     */
    //开始注册
    public function check_reg(){
        //再一次验证 验证码
        if($_SESSION['code']!=$_POST['code']) {
            echo 'fail';
            return false;
        }
        //再一次查看邮箱是否重复 避免 获取完验证码后 修改原邮箱
        $ins=M('instructor');
        $where1['email']=$_POST['email'];
        $inst=$ins->where($where1)->find();
        if($inst){
            echo 'fail email';
            return false;
        }
        $data['real_name'] = $_POST['name'];
//        $data['sex'] = $_POST['sex'] == 1 ? '男' : '女';
        if($_POST["sex"]==MALE){
            $data['sex']=MALE;
        }else{
            $data['sex']=FEMALE;
        }
        //学校和学院 id
//        $dept=M('department');
//        $where['dept_name']=$_POST['dept_name'];
//        $de=$dept->where($where)->find();
//        $data['dept_id']=$de['dept_id'];
        $data["school_id"]=$_POST["school_id"];
        $data["dept_id"]=$_POST["dept_id"];
        $data['ins_number']=$_POST['ins_number'];
        $data['email']=$_POST['email'];
        $data['phone']=$_POST['phone'];
        $data['password']=md5($_POST['password']);
        $in=$ins->add($data);

        if($in){
            echo '注册成功';
            //跳转到登录页面
//            $_SESSION['ins_name']=$_POST['name'];
//            $_SESSION['ins_id']=$in;
//            $_SESSION['school_id']=$de['school_id'];
//            $_SESSION['code']='';
        }
    }
}