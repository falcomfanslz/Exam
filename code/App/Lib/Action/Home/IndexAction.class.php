<?php
/* 类名：		IndexAction
** 类说明：		关于首页跳转的方法
** 位置：		Home
** 作者：		李卓
** 更新时间： 	2014/12/31
** 更新原因：	第一次写入
*/
class IndexAction extends Action {
	/* 方法名：		index
	** 方法说明：	跳转到登陆主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$this->redirect('Home/Login/index');
    }
}