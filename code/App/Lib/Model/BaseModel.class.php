<?php
/* 类名：		BaseModel
** 类说明：		所有Model的基类
** 位置：		Model
** 作者：		李卓
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class BaseModel extends Model{
	/* 属性名：		_auto
	** 属性说明：	自动完成配置
	*/
	protected $_auto = array ( 
		array('updatetime','gettime',3,'callback'),
	);
	//date("Y-m-d H:i:s", intval(($time - 25569) * 3600 * 24));//Excel时间转换用的，放在这里备份吧
	/* 方法名：		add_ByFile
	** 方法说明：	使用文件来输入数据时所用到的方法  以后会修改
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
	/* 方法名：		deldir
	** 方法说明：	删除文件夹的方法
	** 参数：		$dir 需要删除的文件夹路径
	** 返回值：		是否删除
	*/
	Public function deldir($dir) {
		//先删除目录下的文件：
		$dh=opendir($dir);
		while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)) {
					unlink($fullpath);
				} else {
					$this->deldir($fullpath);
				}
			}
		}
		closedir($dh);
		//删除当前文件夹：
		if(rmdir($dir)) {
			return true;
		} else {
			return false;
		}
	}
	/* 方法名：		gettime
	** 方法说明：	获得系统当前时间
	** 参数：		无
	** 返回值：		系统时间
	*/
	public function gettime(){
        return date("Y-m-d H:i:s");
    }
}
?>