<?php
/* ������		CheckAction
** ��˵����		��ʦ������������Ļ���
** λ�ã�		Action/Teacher
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/17
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
		if($type!=2){
			$this->redirect('Home/Login/index');
		}
	}
}