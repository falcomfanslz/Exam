<?php
/* 类名：		ArrangementModel
** 类说明：		教学计划模型
** 位置：		Model
** 作者：		李卓
** 更新时间： 	2015/1/13
** 更新原因：	第一次写入
*/
class ArrangementModel extends BaseModel{
	public function add_ByFile($data=null){
		$this->startTrans();
		$Course = D('Course');
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
}