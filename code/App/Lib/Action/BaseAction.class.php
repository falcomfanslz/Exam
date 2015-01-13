<?php
/* 类名：		BaseAction
** 类说明：		所有类的基类
** 位置：		Action
** 作者：		李卓
** 更新时间： 	2015/1/13
** 更新原因：	第一次写入
*/
class BaseAction extends Action{
	/* 方法名：		_initialize
	** 方法说明：	所有类的构造函数
	** 参数：		无
	** 返回值：		无
	*/
    public function _initialize(){
		//用来检查当前用户的合法性
        /*if(!$this->checkSession()){
			$this->redirect('Home/Login/index');
        }*/
	}
	/* 方法名：		upload
	** 方法说明：	网站的上传方法
	** 参数：		$savepath 文件存储地址 $type 文件格式
	** 返回值：		无
	*/
	protected function upload($savepath = '',$type = 'pdf'){
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();// 实例化上传类
		$upload->maxSize  = 3145728 ;// 设置附件上传大小
		$upload->allowExts  = array($type);// 设置附件上传类型
		$upload->savePath =  './Uploads/'.$savepath;// 设置附件上传目录
		if(!$upload->upload()) {// 上传错误提示错误信息
			$this->error($upload->getErrorMsg());
		}else{// 上传成功 获取上传文件信息
			$info =  $upload->getUploadFileInfo();
		}
		return $info;
    }
	/* 方法名：		read
	** 方法说明：	读取Excel的方法 不要修改
	** 参数：		$filename 文件名 $encode 编码方式
	** 返回值：		分析后的Excel储存为二维数组后返回
	*/
	protected function read($filename,$encode='utf-8'){
        Vendor('Classes.PHPExcel');
        $objReader = PHPExcel_IOFactory::createReader(Excel5); 
        $objReader->setReadDataOnly(true); 
        $objPHPExcel = $objReader->load($filename); 
        $objWorksheet = $objPHPExcel->getActiveSheet(); 
        $highestRow = $objWorksheet->getHighestRow(); 
        $highestColumn = $objWorksheet->getHighestColumn(); 
        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 
        $excelData = array(); 
        for ($row = 1; $row <= $highestRow; $row++) { 
            for ($col = 0; $col < $highestColumnIndex; $col++) { 
                $excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
            } 
        } 
        return $excelData; 
	}
	/* 方法名：		upload_xls
	** 方法说明：	通过xls文件加入数据库
	** 参数：		无
	** 返回值：		无
	*/
	public function upload_xls(){
		$data = array();
		$table_name = $this->_post('table_name');
		$fileinfo = $this->upload('','xls');

		$res = $this->read ( $fileinfo[0]['savepath'] . $fileinfo[0]['savename'] );
		//读取完了就删除掉这个文件（过河拆桥？）
		unlink( $fileinfo[0]['savepath'] . $fileinfo[0]['savename'] );
		foreach ( $res as $k => $v ) {
			if ($k != 0){
				$data [$k] = $v;
			}
		}
		$table = D($table_name);
		$result = $table->add_ByFile($data);
		//插入程序是否出现问题
		if($result){
			//插入的数据是否出现问题
			if($result>=0){
				$this->success('数据库录入成功');
			}else{
				$result = -$result;
				$this->error('第'.$result.'行数据出现问题，请检查。');
			}
		}else{
			$this->error('文件录入发生错误！');
		}

	}
}