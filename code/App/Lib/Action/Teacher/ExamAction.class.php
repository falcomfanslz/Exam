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
		$this->data = $Need->where('tid='.session('username'))->select();
		$this->display();
    }
	/* 方法名：		view
	** 方法说明：	显示课程的详细信息
	** 参数：		无
	** 返回值：		无
	*/
    public function view($id = -1){
		$Exam = D('Examview');
		$Bank = D('Bankview');
		$this->data = $Exam->where("cid=$id")->find();
		$this->bank = $Bank->where("cid=$id and tid=".session('username'))->select();
		$this->display();
    }
	/* 方法名：		add
	** 方法说明：	教师添加试卷的预处理
	** 参数：		无
	** 返回值：		无
	*/
	public function add($id = -1){
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
		$tid = session('username');
		//检查是否有必要上传
		$Bank = D('Bank');		
		if($Bank->where("cid=$cid and tid=$tid and (status=2 or status=3 or status=4)")->count()>=2){
			$this->error('无法上传，请等待审核，或者删除试卷');
		}
		
		$savepath = $cid.'/'.$tid.'/';
		$fileinfo = $this->upload($savepath,'pdf');
		
		$data['cid'] = $cid;
		$data['tid'] = $tid;
		$data['savename'] = $fileinfo[0]['savename'];
		$data['status'] = 2;
		$data['updatetime'] = date("Y-m-d H:i:s");
		$result = $Bank->add($data);
		if($result){
			$this->redirect('Teacher/Exam/index');
		}else{
			unlink($fileinfo[0]['savepath'].$fileinfo[0]['savename']);
			$this->error('上传失败');
		}
	}
	/* 方法名：		delete
	** 方法说明：	教师自己删除试卷
	** 参数：		无
	** 返回值：		无
	*/
	public function delete($id = -1){
		$Bank = D('Bank');
		$data['status'] = 0;
		$Bank->where("id=$id")->save($data);
		$this->redirect('Teacher/Exam/index');
	}
	/* 方法名：		download
	** 方法说明：	教师预览试卷的方法
	** 参数：		$bid 试卷编号
	** 返回值：		无
	*/
	public function download($id=-1){
		//准备试卷基本信息
		$Bank = D('Bankview');
		$bank = $Bank->find($id);
		
		$Exam = D('Examview');
		$exam = $Exam->where('cid='.$bank['cid'])->find();
		
		$path = './Uploads/'.$bank['cid'].'/'.$bank['tid'].'/'.$bank['savename'];
		$filename = $bank['id'].'_'.$exam['coursename'].'_'.$bank['teachername'].'.pdf';
		
		$file = fopen($path,"r"); // 打开文件
		// 输入文件标签
		Header("Content-type: application/octet-stream");
		Header("Accept-Ranges: bytes");
		Header("Accept-Length: ".filesize($path));
		Header("Content-Disposition: attachment; filename=" . $filename);
		// 输出文件内容
		echo fread($file,filesize($path));
		fclose($file);
		exit();
	}
}