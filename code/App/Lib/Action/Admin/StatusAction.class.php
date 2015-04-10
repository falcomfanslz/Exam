<?php
/* 类名：		StatusAction
** 类说明：		用于管理系统各阶段控制的类,请在系统配置完后删除此文件
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/3/29
** 更新原因：	第一次写入
*/
class StatusAction extends Action{
	/* 方法名：		index
	** 方法说明：	显示所有状态管理信息
	** 参数：		无
	** 返回值：		无
	*/
	public function index(){
		$Status = D('Status');
		$this->data = $Status->order('classname')->select();
		$this->display();
	}
	
	/* 方法名：		insert
	** 方法说明：	向数据库插入一条状态信息
	** 参数：		无
	** 返回值：		无
	*/
	public function insert(){
		//状态检查
		$Status = D('Status');
		if($Status->create()){
			//防止阶段控制类被锁上
			if($Status->data['classname']==MODULE_NAME){
				$this->error('呃。。。这个类就不要锁上了');
			}
			$result = $Status->add();
			if($result) {
				$this->redirect('Admin/Status/index');
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($Course->getError());
		}
	}
}