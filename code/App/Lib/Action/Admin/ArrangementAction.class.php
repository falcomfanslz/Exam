<?php
/* ������		ArrangementAction
** ��˵����		���ڹ���Ա������ѧ�ƻ�����
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/13
** ����ԭ��	��һ��д��
*/
class ArrangementAction extends CheckAction {
	/* ��������		_initialize
	** ����˵����	������Ĺ��캯��
	** ������		��
	** ����ֵ��		��
	*/
    public function _initialize(){
		//������鵱ǰ�û��ĺϷ���
        /*if(!$this->checkSession()){
			$this->redirect('Home/Login/index');
        }*/
	}
	/* ��������		index
	** ����˵����	��ʾ��ѧ�ƻ���ҳ
	** ������		��
	** ����ֵ��		��
	*/
    public function index(){
		$Arrangementview = D('Arrangementview'); // ʵ����Data����ģ��	 
		$this->data = $Arrangementview->select();
		$this->display();
    }
	/* ��������		add
	** ����˵����	ͨ���ļ������ѧ�ƻ���Ϣ
	** ������		��
	** ����ֵ��		��
	*/
    /*public function insert(){
		$Arrangementview = D('Arrangementview'); // ʵ����Data����ģ��	 
		$this->data = $Arrangementview->select();
		$this->display();
    }*/
}