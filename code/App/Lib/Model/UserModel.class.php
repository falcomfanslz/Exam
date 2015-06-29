<?php
/* 类名：		UserModel
** 类说明：		关于用户信息的增删改查
** 位置：		Model
** 作者：		李卓
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class UserModel extends BaseModel {
	protected  $_auto = array ( 
		array('password','double_md5',3,'callback'), // 对password字段在新增的时候使md5函数处理
	);
	/* 方法名：		add_ByFile
	** 方法说明：	使用文件来输入数据时所用到的方法  密码md5加密
	** 参数：		无
	** 返回值：		无
	*/
	public function add_ByFile($data=null){
		$this->startTrans();
		$this->create();
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
	public function double_md5($password){
		return md5(md5($password));
	}
}
?>