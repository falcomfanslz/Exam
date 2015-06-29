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
		$Arrangement = D('Arrangement');
		$Bank = D('Bank'); 
		$Examview = D('Examview');
		$Bankview = D('Bankview');
		
		$arrangement = $Arrangement->where("cid='$id'")->find();
		if($arrangement['status']==0){
			$this->error('考试还未开始');
		}else{
			//判断是否已经抽好试卷
			$examdata = $Examview->where("cid='$id'")->find();
			if($examdata['status']==1){
				//试卷状态改变操作
				$bid = $Bank->extract("'".$id."'");
			}else{
				$bid = $examdata['bid'];
			}
			if($bid){
				$this->download($bid);
			}else{
				$this->error('操作错误');
			}
		}
		
		
    }	
	/* 方法名：		download
	** 方法说明：	下载试卷的方法
	** 参数：		$bid 试卷编号
	** 返回值：		无
	*/
	public function download($bid=-1){
		//准备试卷基本信息
		$Bank = D('Bankview');
		$bank = $Bank->find($bid);
		
		$Exam = D('Examview');
		$exam = $Exam->where('cid='."'".$bank['cid']."'")->find();
		
		$path = './Uploads/'.$bank['cid'].'/'.$bank['tid'].'/'.$bank['savename'];
		$filename = $bank['id'].'_'.$exam['coursename'].'_'.$bank['teachername'].'.pdf';
		
		$Course = D('Course');
		$course = $Course->find($bank['cid']);
		
		//判断考试班级是否修改过
		$classname = '';
		if($course['classlist']!=''){
			$classname = $course['classlist'];
		}else{
			$classname = $exam['classname'];
		}
		$school = get_info('INFO_SCHOOL');
		$year = get_info('INFO_YEAR');
		$term = get_info('INFO_TERM');
		$type = get_info('INFO_TYPE');
		//修改试卷
		Vendor('Classes.TCPDF.PDF');
		$pdf = new PDF();
		$pdf->edit($path,$filename,$school,$bank['teachername'],'',$exam['systemname'],$year,$term,$type,$exam['coursename'],$classname,$course['type']);
	}
}