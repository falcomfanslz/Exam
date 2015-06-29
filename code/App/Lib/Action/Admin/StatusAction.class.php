<?php
/* ������		StatusAction
** ��˵����		���ڹ���ϵͳ���׶ο��Ƶ���,����ϵͳ�������ɾ�����ļ�
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/3/29
** ����ԭ��	��һ��д��
*/
class StatusAction extends CheckAction{
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
			}else if($Status->data['classname']=='Index'){
				$this->error('��ҳ��Ҳ��Ҫ������');
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
	/* ��������		delete
	** ����˵����	ɾ��һ��ϵ����Ϣ����
	** ������		$id �γ���Ʊ��
	** ����ֵ��		��
	*/
	public function delete($id = -1){
		if($id == -1) $this->redirect('Admin/Status/index');
		$Status = D('Status');
		$result=$Status->delete($id);
		if($result) {
			$this->redirect('Admin/Status/index');
		}else{
			$this->error('ɾ������');
		}
	}
}