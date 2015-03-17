<?php
/* 类名：		LoginAction
** 类说明：		关于登陆的所有方法
** 位置：		Home
** 作者：		李卓
** 更新时间： 	2015/1/27
** 更新原因：	第一次写入
*/
class LoginAction extends Action {
	
	/* 方法名：		index
	** 方法说明：	显示登陆主页
	** 参数：		无
	** 返回值：		无
	*/
	public function index(){
		
		$this->display();
		
	}
	
	/* 方法名：		login
	** 方法说明：	登陆检查，并跳转
	** 参数：		无
	** 返回值：		无
	*/
	public function login(){
		//初始化参数
		$username = $this->_post('username');
		$password = strval($this->_post('password'));//转换成字符串 否则以数字的形式容易出错
		$type = $this->_post('type');
		$typelist = array('Admin','Dean','Teacher','Printer');
		//数据实例化
		$User = D('User');
		$data = $User->where('id='.$username.' and type='.$type)->find();
		if($data['id']!=null){
			if($data['password']===$password){
				//用户名和密码都没有问题
				session('username',$username);
				session('type',$type);
				$this->redirect($typelist[$type].'/Index/index');
			}else{
				$this->redirect('Home/Login/index','',3,'密码错误');
			}
		}else{
			$this->redirect('Home/Login/index','',3,'用户名不存在');
		}
	}
	/* 方法名：		top
	** 方法说明：	所有用户的标题界面
	** 参数：		无
	** 返回值：		无
	*/
	public function top(){
		//初始化参数
		$username = session('username');
		$User = D('User');
		$this->Userdata = $User->where('id='.$username)->find();
		$this->systemStatusName = get_statusName();
		$this->display();
	}
	/* 方法名：		loginout
	** 方法说明：	注销掉所有SESSION
	** 参数：		无
	** 返回值：		无
	*/
	public function loginout(){
		//清空session
		session(null);
		//跳转
		$this->redirect('Home/Login/index','',3,'注销成功');
	}
}