<?php
/* 类名：		InfoAction
** 类说明：		配置试卷题头的基本信息
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/6/21
** 更新原因：	第一次写入
*/
class InfoAction extends CheckAction{
	/* 方法名：		index
	** 方法说明：	显示所有状态管理信息
	** 参数：		无
	** 返回值：		无
	*/
	public function index(){
		$this->school = get_info('INFO_SCHOOL');
		$this->year = get_info('INFO_YEAR');
		$this->term = get_info('INFO_TERM');
		$this->type = get_info('INFO_TYPE');
		$this->display();
	}
	
	/* 方法名：		update
	** 方法说明：	修改系统信息
	** 参数：		无
	** 返回值：		无
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