<?php
/* 类名：		BankModel
** 类说明：		关于题库信息的增删改查
** 位置：		Model
** 作者：		李卓
** 更新时间： 	2015/1/17
** 更新原因：	第一次写入
*/
class BankModel extends BaseModel {
	/* 方法名：		extract
	** 方法说明：	抽取试卷要执行的操作
	** 参数：		$bid 试题编号，$cid 课程编号
	** 返回值：		抽取到的试卷编号
	*/
	public function extract($cid){
		$flag = false;
		//从数据库中随机查询一条试卷数据
		$where = "where (status=4 or status=3) and cid=$cid";//搜索条件
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
			$this->startTrans();//开启事务
			//课程信息修改
			$Arrangement = D('Arrangement');
			$arrangement['status'] = 2;
			$arrangement['bid'] = $bankdata[0]['id'];
			$result1 = $Arrangement->where('cid='.$cid)->save($arrangement);
			//试卷信息修改
			$Bank = D('Bank');
			$bank['id'] = $bankdata[0]['id'];
			$bank['status'] = 5;
			$result2 = $Bank->save($bank);
			if($result1!=false&&$result2!=false){
				$this->commit();
				//把试卷编号发回去
				$flag = $bankdata[0]['id'];
			}else{
				$this->rollback();
			}
		}
		return $flag;
    }
}