<?php
/* 类名：		ExamAction
** 类说明：		关于管理员操作考试的类
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/1/15
** 更新原因：	第一次写入
*/
class ExamAction extends BaseAction {
	/* 方法名：		index
	** 方法说明：	显示考试信息主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Examview = D('Examview'); // 实例化Data数据模型	 
		$this->data = $Examview->select();
		$this->display();
    }
	/* 方法名：		view
	** 方法说明：	显示一条考试的详细信息
	** 参数：		无
	** 返回值：		无
	*/
    public function view($id=-1){
		if($id == -1) $this->redirect('Admin/Exam/index');//保护	
		$Examview = D('Examview'); // 实例化Data数据模型	 
		$this->data = $Examview->where('cid='.$id)->find();
		
		$Needview = D('Needview');
		$this->need = $Needview->where('cid='.$id)->order('cid')->select();
		
		$this->display();
    }
}