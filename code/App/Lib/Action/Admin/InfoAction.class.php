<?php
/* ������		InfoAction
** ��˵����		�����Ծ���ͷ�Ļ�����Ϣ
** λ�ã�		Action/Admin
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/6/21
** ����ԭ��	��һ��д��
*/
class InfoAction extends CheckAction{
	/* ��������		index
	** ����˵����	��ʾ����״̬������Ϣ
	** ������		��
	** ����ֵ��		��
	*/
	public function index(){
		$this->school = get_info('INFO_SCHOOL');
		$this->year = get_info('INFO_YEAR');
		$this->term = get_info('INFO_TERM');
		$this->type = get_info('INFO_TYPE');
		$this->display();
	}
	
	/* ��������		update
	** ����˵����	�޸�ϵͳ��Ϣ
	** ������		��
	** ����ֵ��		��
	*/
	public function update(){
		$school = $this->_post('school');
		$year = $this->_post('year');
		$term = $this->_post('term');
		$type = $this->_post('type');
		set_info('INFO_SCHOOL',$school);
		set_info('INFO_YEAR',$year);
		set_info('INFO_TERM',$term);
		set_info('INFO_TYPE',$type);
		$this->redirect('Admin/Info/index');
	}

}