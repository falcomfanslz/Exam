<?php
/* 类名：		IndexAction
** 类说明：		关于管理员显示主页的方法
** 位置：		Admin
** 作者：		李卓
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class IndexAction extends Action {
	/* 方法名：		index
	** 方法说明：	显示管理员主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$this->display();
    }
}