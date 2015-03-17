<?php
/* 类名：		ExamCheckAction
** 类说明：		关于系主任显示本系学期考试的方法
** 位置：		Teacher
** 作者：		李卓
** 更新时间： 	2015/1/16
** 更新原因：	第一次写入
*/
class ExamCheckAction extends CheckAction {
	/* 方法名：		index
	** 方法说明：	显示本学期的课程考试信息
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Need = D('Needview');
		$this->data = $Need->where('sid=1 and status<=5')->select();//编号暂时是固定的
		$this->display();
    }
	/* 方法名：		check
	** 方法说明：	审核教师试卷的方法
	** 参数：		$operate 审核结果，$id 试卷编号
	** 返回值：		无
	*/
	public function check($operate=-1,$id=-1){
		if($operate == -1) $this->redirect('Dean/ExamCheck/index');
		if($bid == -1) $this->redirect('Dean/ExamCheck/index');
		
		//审核操作
		if($operate==1){
			$status = 5;
		}else if($operate==0){
			$status = 4;
		}else{
			$status = 0;
		}
		
		//保存设置
		$Bank = D('Bank');
		$data['status'] = $status;
		$Bank->where('id='.$id)->save($data);
		
		
		$this->redirect('Dean/ExamCheck/index');
	}
	/* 方法名：		download
	** 方法说明：	下载试卷的方法
	** 参数：		$bid 试卷编号
	** 返回值：		无
	*/
	public function download($bid=-1){
		if($bid == -1) $this->redirect('Dean/ExamCheck/index');
		//准备试卷基本信息
		$Bank = D('Bankview');
		$bank = $Bank->find($bid);
		
		$Exam = D('Examview');
		$exam = $Exam->where('cid='.$bank['cid'])->find();
		
		$path = './Uploads/'.$bank['cid'].'/'.$bank['tid'].'/'.$bank['savename'];
		$filename = $bank['id'].'_'.$exam['coursename'].'_'.$bank['teachername'].'.pdf';
		
		//修改试卷
		Vendor('Classes.TCPDF.PDF');
		$pdf = new PDF();
		$pdf->edit($path,$filename,'哈尔滨理工大学',$bank['teachername'],$exam['deanname'],$exam['systemname'],'2013--2014','1','B',$exam['coursename'],$exam['classname']);
	}
}