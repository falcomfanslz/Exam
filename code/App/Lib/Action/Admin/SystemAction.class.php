<?php
/* 类名：		SystemAction
** 类说明：		管理系部的操作方法
** 位置：		Action/Admin
** 作者：		商家赫
*/
class SystemAction extends Action {
	/* 方法名：		index
	** 方法说明：	显示课程设计操作主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$System = D('System'); 
		$this->data = $System->select();
		$this->display();
    }
	
	
	/* 方法名：		insert
	** 方法说明：	向数据库插入一条系部信息
	** 参数：		无
	** 返回值：		无
	*/
	public function insert(){
		$System = D('System');
        if($System->create()) {
			$result = $System->add();
			if($result) {
				$this->redirect('Admin/System/index');
			}else{
				$this->error('写入错误！');
			}
        }else{
            $this->error($System->getError());
        }
	}
	
	/* 方法名：		edit
	** 方法说明：	把一条系部数据读取出来用来修改
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function edit($id = -1){
		if($id == -1) $this->redirect('Admin/System/index');
		$System = D('System');
		$System = D('System');
		$data=$System->find($id);
		if($data){
			// 模板变量赋值
			$this->system = $System->select();
			$this->data = $data;
		}else{
			$this->error('数据错误');
		}
		$this->display();
	}
	
	/* 方法名：		update
	** 方法说明：	更新一条系部信息数据
	** 参数：		无
	** 返回值：		无 
	*/
	public function update(){
		$System = D('System');
		if($System->create()) {
			$result =   $System->save();
			if($result) {
				$this->redirect('Admin/System/index');
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($System->getError());
		}
	}
	
	/* 方法名：		delete
	** 方法说明：	删除一条系部信息数据
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function delete($id = -1){
		if($id == -1) $this->redirect('Admin/System/index');
		$System = D('System');
		$result=$System->delete($id);
		if($result) {
			$this->redirect('Admin/System/index');
		}else{
			$this->error('删除错误！');
		}
	}
}