<?php
/* ������		StatusAction
** ��˵����		���ڹ���ϵͳ���׶ο��Ƶ���,����ϵͳ�������ɾ�����ļ�
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/3/29
** ����ԭ��	��һ��д��
*/
class StatusAction extends Action{
	/* ��������		index
	** ����˵����	��ʾ����״̬������Ϣ
	** ������		��
	** ����ֵ��		��
	*/
	public function index(){
		$Status = D('Status');
		$this->data = $Status->order('classname')->select();
		$this->display();
	}
	
	/* ��������		insert
	** ����˵����	�����ݿ����һ��״̬��Ϣ
	** ������		��
	** ����ֵ��		��
	*/
	public function insert(){
		//״̬���
		$Status = D('Status');
		if($Status->create()){
			//��ֹ�׶ο����౻����
			if($Status->data['classname']==MODULE_NAME){
				$this->error('�������������Ͳ�Ҫ������');
			}
			$result = $Status->add();
			if($result) {
				$this->redirect('Admin/Status/index');
			}else{
				$this->error('д�����');
			}
		}else{
			$this->error($Course->getError());
		}
	}
}