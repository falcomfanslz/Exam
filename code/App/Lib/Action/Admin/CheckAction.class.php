<?php
/* 类名：		CheckAction
** 类说明：		管理员操作里所有类的基类
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/1/27
** 更新原因：	第一次写入
*/
class CheckAction extends BaseAction {
	/* 方法名：		_initialize
	** 方法说明：	所有类的构造函数
	** 参数：		无
	** 返回值：		无
	*/
    public function _initialize(){
		parent::_initialize();
		//用来检查当前用户的合法性
        $type = Session('type');
		if($type!=0||$type==null){//php里0==null，所以这么写了
			$this->redirect('Home/Login/index');
		}
	}
}