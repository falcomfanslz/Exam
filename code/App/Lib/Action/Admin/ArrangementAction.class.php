<?php
/* 类名：		ArrangementAction
** 类说明：		关于管理员操作教学计划的类
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/1/13
** 更新原因：	第一次写入
*/
class ArrangementAction extends CheckAction {
	/* 方法名：		_initialize
	** 方法说明：	所有类的构造函数
	** 参数：		无
	** 返回值：		无
	*/
    public function _initialize(){
		//用来检查当前用户的合法性
        /*if(!$this->checkSession()){
			$this->redirect('Home/Login/index');
        }*/
	}
	/* 方法名：		index
	** 方法说明：	显示教学计划主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Arrangementview = D('Arrangementview'); // 实例化Data数据模型	 
		$this->data = $Arrangementview->select();
		$this->display();
    }
	/* 方法名：		add
	** 方法说明：	通过文件插入教学计划信息
	** 参数：		无
	** 返回值：		无
	*/
    /*public function insert(){
		$Arrangementview = D('Arrangementview'); // 实例化Data数据模型	 
		$this->data = $Arrangementview->select();
		$this->display();
    }*/
}