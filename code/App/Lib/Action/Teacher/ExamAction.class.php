<?php
/* 类名：		ExamAction
** 类说明：		关于教师显示学期考试的方法
** 位置：		Teacher
** 作者：		李卓
** 更新时间： 	2015/1/16
** 更新原因：	第一次写入
*/
class ExamAction extends CheckAction {
	/* 方法名：		index
	** 方法说明：	显示本学期的课程考试信息
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Need = D('Needview');
		$this->data = $Need->where('tid=123456 and (status<5 or status is NULL)')->select();//编号暂时是固定的
		$this->display();
    }
	/* 方法名：		add
	** 方法说明：	教师添加试卷的预处理
	** 参数：		无
	** 返回值：		无
	*/
	public function add($id = -1){
		if($id == -1) $this->redirect('Teacher/Exam/index');//保护	
		session('cid',$id);
		$Course = D('Courseview');
		$this->course = $Course->where('id='.$id)->find();
		$this->display();
	}
	/* 方法名：		upload_pdf
	** 方法说明：	教师添加试卷上传处理
	** 参数：		无
	** 返回值：		无
	*/
	public function upload_pdf(){
		$cid = session('cid');
		$tid = '123456';//以后会改的
		
		//检查是否有必要上传
		$Bank = D('Bank');
		if($Bank->where("cid=$cid and tid=$tid and status<5")->count()>=2){
			$this->error('无法上传，请等待审核，或者删除试卷');
		}
		
		$savepath = $cid.'/'.$tid.'/';
		$fileinfo = $this->upload($savepath,'pdf');
		
		$data['cid'] = $cid;
		$data['tid'] = $tid;
		$data['savename'] = $fileinfo[0]['savename'];
		$data['status'] = 0;
		$data['updatetime'] = date("Y-m-d H:i:s");
		$result = $Bank->add($data);
		if($result){
			$this->redirect('Teacher/Exam/index');
		}else{
			unlink($fileinfo[0]['savepath'].$fileinfo[0]['savename']);
			$this->error('上传失败');
		}
	}
}