<?php
/* ������		CheckAction
** ��˵����		��ӡ�������������Ļ���
** λ�ã�		Action/Printer
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/27
** ����ԭ��	��һ��д��
*/
class CheckAction extends BaseAction {
	/* ��������		_initialize
	** ����˵����	������Ĺ��캯��
	** ������		��
	** ����ֵ��		��
	*/
    public function _initialize(){
		//������鵱ǰ�û��ĺϷ���
        $type = Session('type');
		if($type!=3){
			$this->redirect('Home/Login/index');
		}
	}
}