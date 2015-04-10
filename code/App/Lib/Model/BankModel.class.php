<?php
/* ������		BankModel
** ��˵����		���������Ϣ����ɾ�Ĳ�
** λ�ã�		Model
** ���ߣ�		��׿
** ����ʱ�䣺 	2015/1/17
** ����ԭ��	��һ��д��
*/
class BankModel extends BaseModel {
	/* ��������		extract
	** ����˵����	��ȡ�Ծ�Ҫִ�еĲ���
	** ������		$bid �����ţ�$cid �γ̱��
	** ����ֵ��		��ȡ�����Ծ���
	*/
	public function extract($cid){
		$flag = false;
		//�����ݿ��������ѯһ���Ծ�����
		$where = "where (status=4 or status=3) and cid=$cid";//��������
		$bankdata = $this->query("
			SELECT *
			FROM exam_bank AS t1 
				JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `exam_bank` $where)
				-(SELECT MIN(id) FROM `exam_bank` $where))
				+(SELECT MIN(id) FROM `exam_bank` $where))
				AS id) AS t2
			WHERE t1.id >= t2.id
			ORDER BY t1.id LIMIT 1;
		");
		if($bankdata){
			$this->startTrans();//��������
			//�γ���Ϣ�޸�
			$Arrangement = D('Arrangement');
			$arrangement['status'] = 2;
			$arrangement['bid'] = $bankdata[0]['id'];
			$result1 = $Arrangement->where('cid='.$cid)->save($arrangement);
			//�Ծ���Ϣ�޸�
			$Bank = D('Bank');
			$bank['id'] = $bankdata[0]['id'];
			$bank['status'] = 5;
			$result2 = $Bank->save($bank);
			if($result1!=false&&$result2!=false){
				$this->commit();
				//���Ծ��ŷ���ȥ
				$flag = $bankdata[0]['id'];
			}else{
				$this->rollback();
			}
		}
		return $flag;
    }
}