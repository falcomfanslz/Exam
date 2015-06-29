<?php
/* ������		UserModel
** ��˵����		�����û���Ϣ����ɾ�Ĳ�
** λ�ã�		Model
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/12
** ����ԭ��	��һ��д��
*/
class UserModel extends BaseModel {
	protected  $_auto = array ( 
		array('password','double_md5',3,'callback'), // ��password�ֶ���������ʱ��ʹmd5��������
	);
	/* ��������		add_ByFile
	** ����˵����	ʹ���ļ�����������ʱ���õ��ķ���  ����md5����
	** ������		��
	** ����ֵ��		��
	*/
	public function add_ByFile($data=null){
		$this->startTrans();
		$this->create();
		//��õ�ǰ����ֶ���
		$field = $this->getDbFields();
		$datalist = array();
		//������Ķ�ά���ݽ��в���
		foreach ( $data as $k => $v ){
		   if ($k != 0){
				foreach($field as $kk => $vv){
					if($vv!='updatetime')
						$datalist[$k][$vv] = $v[$kk];
					else 
						$datalist[$k][$vv] = date("Y-m-d H:i:s");
				}
				$result = $this->add($datalist[$k]);
				//�������ʧ�ܾͷ���Ϊ��ֵ������
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