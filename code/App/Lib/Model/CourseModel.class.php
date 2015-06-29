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
	public function add_dir($id){
		//调用父类add方法
		$result = parent::add();
		//创建文件夹
		mkdir('./Uploads/'.$id,0777);
		return $result;
	}
	/* 方法名：		delete
	** 方法说明：	加入了删除文件夹功能
	** 参数：		$id 课程编号
	** 返回值：		删除结果
	*/
	public function delete($id){
		//调用父类add方法
		$result = parent::delete($id);
		//删除文件夹
		$this->deldir('./Uploads/'.$id);
		return $result;
	}
	/* 方法名：		add_ByFile
	** 方法说明：	添加了增加文件夹功能
	** 参数：		无
	** 返回值：		无
	*/
	public function add_ByFile($data=null){
		$this->startTrans();
		//获得当前表的字段名
		$field = $this->getDbFields();
		$datalist = array();
		//对输入的二维数据进行操作
		foreach ( $data as $k => $v ){
		   if ($k != 0){
				foreach($field as $kk => $vv){
					if($vv!='updatetime')
						$datalist[$k][$vv] = $v[$kk];
					else 
						$datalist[$k][$vv] = date("Y-m-d H:i:s");
				}
				$result = $this->add($datalist[$k]);
				//创建文件夹,PS：这里写得很烂，望以后改进啦
				mkdir('./Uploads/'.$datalist[$k]['id'],0777);
				//如果插入失败就返回为负值的行数
				if(!$result){
					$result = -$k;
					break;
				}
			}
		}
		if($result >= 0){
			$this->commit();
		}else{
			$this->rollback();
		}
		return $result;
	}
}
?>