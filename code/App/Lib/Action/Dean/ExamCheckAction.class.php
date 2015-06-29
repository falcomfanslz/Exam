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
		$this->data = $Need->group('cid')->where('sid='.session('sid'))->select();
		$this->display();
    }
	/* 方法名：		view
	** 方法说明：	显示课程的详细信息
	** 参数：		无
	** 返回值：		无
	*/
    public function view($id = -1){
		$id = "'".$id."'";
		$Exam = D('Examview');
		$Bank = D('Bankview');
		$this->data = $Exam->where("cid=$id")->find();
		$this->bank = $Bank->where("cid=$id and (status=2 or status=3 or status=4)")->select();
		$this->display();
    }
	/* 方法名：		check
	** 方法说明：	审核教师试卷的方法
	** 参数：		$operate 审核结果，$id 试卷编号
	** 返回值：		无
	*/
	public function check($operate=-1,$id=-1){
		//审核操作
		if($operate==1){
			$status = 4;
		}else if($operate==0){
			$status = 1;
		}else{
			$status = 0;
		}
		
		$Bank = D('Bank');
		$Arrangement = D('Arrangement');
		//查询当前试卷信息
		$bank = $Bank->where('id='.$id)->find();
		//查询当前课程状态，如果管理员已同意考试，则系主任无权修改评审信息
		$arrangement = $Arrangement->where('cid='.$bank['cid'])->find();
		if($arrangement['status']!=0){
			$this->error('考试已经开始，无法修改审核信息');
		}else{
			//将审核信息录入数据库
			$examnumber = $Bank->where('cid='.$bank['cid'].'and tid='.$bank['tid']);
			$data['status'] = $status;
			$Bank->where('id='.$id)->save($data);

			$this->redirect('Dean/ExamCheck/view',array('id'=>$bank['cid']));
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
		$exam = $Exam->where('cid='.$bank['cid'])->find();
		
		$Course = D('Course');
		$course = $Course->find($bank['cid']);
		
		$path = './Uploads/'.$bank['cid'].'/'.$bank['tid'].'/'.$bank['savename'];
		$filename = $bank['id'].'_'.$exam['coursename'].'_'.$bank['teachername'].'.pdf';
		
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