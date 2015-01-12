<?php
/* 类名：		CourseModel
** 类说明：		关于课程信息的增删改查
** 位置：		Model
** 作者：		李卓
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class CourseModel extends BaseModel {
	/* 方法名：		add
	** 方法说明：	加入了创建文件夹功能
	** 参数：		$id 课程编号
	** 返回值：		加入结果
	*/
	public function add($id){
		//调用父类add方法
		$result = parent::add();
		//创建文件夹
		mkdir('./Uploads/'.$id,0777);
		return $result;
	}
	/* 方法名：		delete
	** 方法说明：	加入了删除文件夹功能
	** 参数：		$id 课程编号
	** 返回值：		加入结果
	*/
	public function delete($id){
		//调用父类add方法
		$result = parent::delete($id);
		//删除文件夹
		$this->deldir('./Uploads/'.$id);
		return $result;
	}
}
?>