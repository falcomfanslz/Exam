<?php
/* ������		ExamAction
** ��˵����		���ڹ���Ա�������Ե���
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/15
** ����ԭ��	��һ��д��
*/
class ExamAction extends CheckAction {
	/* ��������		index
	** ����˵����	��ʾ������Ϣ��ҳ
	** ������		��
	** ����ֵ��		��
	*/
    public function index(){
		$Examview = D('Examview'); // ʵ����Data����ģ��	 
		$this->data = $Examview->select();
		$this->display();
    }
	/* ��������		view
	** ����˵����	��ʾһ�����Ե���ϸ��Ϣ
	** ������		��
	** ����ֵ��		��
	*/
    public function view($id=-1){
		if($id == -1) $this->redirect('Admin/Exam/index');//����

		$Course = D('Course');
		$course = $Course->find($id);
		
		$id = "'".$id."'";
		$Examview = D('Examview'); // ʵ����Data����ģ��	 
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
	/* ��������		pass
	** ����˵����	���ſ��Կ��Դ�ӡ
	** ������		$cid
	** ����ֵ��		��
	*/
    public function pass($cid=-1){
		$Arrangement = D('Arrangement');
		$data['status'] = 1;
		$Arrangement->where("cid='$cid'")->save($data);
		$this->redirect('Admin/Exam/view',array('id' => $cid));
    }
}