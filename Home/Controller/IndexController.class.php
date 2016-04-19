<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;

/**
 * Class IndexController 这个控制器主要用于教师端登录 学生端登录在StudentController
 * @package Home\Controller
 */
class IndexController extends Controller {
	/**
	 * 登录页面
	 *
	 * 如果有session信息，直接跳转到首页 页面上可跳转到注册页面
	 */
	public function login(){
		if(isset($_SESSION['ins_name'])||isset($_SESSION['stu_id'])){
			$this->redirect('Index/index');
		}
		$this->display();
	}

	/**
	 * 教师端登录验证
	 *
	 * @return bool
	 */
	public function check_login(){
		//帐号为邮箱
		$in=M('instructor');
		$where['email']=$_POST['email'];
		$where['password']=md5($_POST['password']);
		$ins=$in->where($where)->find();
		if($ins){
			echo'success';
//			$_SESSION['ins_name']=$ins['real_name'];
//			$_SESSION['ins_id']=$ins['id'];
//			$dept=M('department');
//			$where1['dept_id']=$ins['dept_id'];
//			$de=$dept->where($where1)->find();
//			$_SESSION['school_id']=$ins['school_id'];
			$_SESSION["user"]=$ins;
		}else{
			echo 'fail';
			return false;
		}
	}
	public function logout(){
		session_destroy();
		$this->redirect('Index/login');
	}

	/**
	 * 教师后台主页
	 */
	public function index(){
		if(!isset($_SESSION['ins_name'])){
			$this->redirect('Index/login');
		}
//		var_dump($_SESSION);
//		$this->assign('ins',$_SESSION['ins_name']);
		$this->display();
	}

}