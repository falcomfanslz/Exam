<?php
/* ������		ExamAction
** ��˵����		���ڹ���Ա�������Ե���
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/15
** ����ԭ��	��һ��д��
*/
class ExamAction extends BaseAction {
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
		$Examview = D('Examview'); // ʵ����Data����ģ��	 
		$this->data = $Examview->where('cid='.$id)->find();
		
		$Needview = D('Needview');
		$this->need = $Needview->where('cid='.$id)->order('cid')->select();
		
		$this->display();
    }
}