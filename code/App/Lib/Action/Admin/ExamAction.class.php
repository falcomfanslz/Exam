<?php
/* 类名：		ExamAction
** 类说明：		关于管理员操作考试的类
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/1/15
** 更新原因：	第一次写入
*/
class ExamAction extends CheckAction {
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

		$Course = D('Course');
		$course = $Course->find($id);
		
		$id = "'".$id."'";
		$Examview = D('Examview'); // 实例化Data数据模型	 
		$this->data = $Examview->where('cid='.$id)->find();
		

		if($course['classlist']!=''){
			$this->classlist = $course['classlist'];
		}else{
			$this->classlist = $this->data['classname'];
		}
		$Bankview = D('Bankview');
		$this->need = $Bankview->where("cid=$id and (status=3 or status=4 or status=5)")->order('cid')->select();
		
		$Teacherview = D('Teacherview');
		$this->teacher = $Teacherview->where("cid=$id")->group("tid")->select();
		
		$this->display();
    }
	/* 方法名：		pass
	** 方法说明：	该门考试可以打印
	** 参数：		$cid
	** 返回值：		无
	*/
    public function pass($cid=-1){
		$Arrangement = D('Arrangement');
		$data['status'] = 1;
		$Arrangement->where("cid='$cid'")->save($data);
		$this->redirect('Admin/Exam/view',array('id' => $cid));
    }
}