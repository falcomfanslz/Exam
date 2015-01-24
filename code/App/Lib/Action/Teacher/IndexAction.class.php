<?php
/* 类名：		IndexAction
** 类说明：		关于教师显示主页的方法
** 位置：		Teacher
** 作者：		李卓
** 更新时间： 	2015/1/16
** 更新原因：	第一次写入
*/
class IndexAction extends Action {
	/* 方法名：		index
	** 方法说明：	显示教师主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$this->display();
    }
}