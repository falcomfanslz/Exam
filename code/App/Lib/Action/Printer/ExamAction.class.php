<?php
/* 类名：		ExamAction
** 类说明：		关于打印社操作考试的类
** 位置：		Action/Printer
** 作者：		李卓
** 更新时间： 	2015/1/19
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
	/* 方法名：		extract
	** 方法说明：	抽取一张试卷
	** 参数：		无
	** 返回值：		无
	*/
    public function extract($id=-1){
		if($id == -1) $this->redirect('Printer/Exam/index');//保护	
		$Bank = D('Bank'); 
		$Examview = D('Examview');
		$Bankview = D('Bankview');
		
		//判断是否已经抽好试卷
		$examdata = $Examview->where('cid='.$id)->find();
		if($examdata['status']==0){
			//试卷状态改变操作
			$bid = $Bank->extract($id);
		}else{
			$bid = $examdata['bid'];
		}
		if($bid){
			//试卷名称初始化
			$bank = $Bankview->where('id='.$bid)->find();
			$exam = $Examview->where('cid='.$bank['cid'])->find();
			$path = './Uploads/'.$bank['cid'].'/'.$bank['tid'].'/'.$bank['savename'];
			$filename = $bank['id'].'_'.$exam['coursename'].'_'.$bank['teachername'].'.pdf';
			$this->downloadFile($path,$filename);
		}else{
			$this->error('操作错误');
		}
    }	
}