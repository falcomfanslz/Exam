<?php
/* 类名：		UserAction
** 类说明：		关于管理员用户管理的所有方法
** 位置：		Action/Admin
** 作者：		武国斌
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class UserAction extends Action {
	/* 方法名：		index
	** 方法说明：	显示用户信息操作主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$userview = D('userview'); // 实例化Data数据模型	 
		$this->data = $userview->select();
		$this->display();
    }
	
	/* 方法名：		add
	** 方法说明：	添加一条用户信息的准备步骤
	** 参数：		无
	** 返回值：		无
	*/
    public function add(){
		$System = D('System'); // 实例化Data数据模型	 
		$this->system = $System->select();
		$this->display();
    }
	
	/* 方法名：		insert
	** 方法说明：	向数据库插入一条用户信息
	** 参数：		无
	** 返回值：		无
	*/
	public function insert(){
		$User = D('User');
        if($User->create()) {
			$result = $User->add();
			if($result) {
				$this->redirect('Admin/User/index');
			}else{
				$this->error('写入错误！');
			}
        }else{
            $this->error($User->getError());
        }
	}
	
	/* 方法名：		delete
	** 方法说明：	删除一条用户信息数据（未完成，不完整）
	** 参数：		$id 用户编号
	** 返回值：		无
	*/
	public function delete($id = -1){
		if($id == -1) $this->redirect('Admin/User/index');//保护
		$User = D('User');
		$result=$User->delete($id);
		if($result) {
			$this->redirect('Admin/User/index');
		}else{
			$this->error('删除错误！');
		}
	}
	
	/* 方法名：		edit
	** 方法说明：	把一条用户数据读取出来，以便修改
	** 参数：		$id 用户编号
	** 返回值：		无
	*/
	public function edit($id = -1){
		if($id == -1) $this->redirect('Admin/User/index');//保护
		$User = D('User');
		$System = D('System');
		$userview = D('userview');
		$data=$User->find($id);
		if($data){
			// 模板变量赋值
			$this->system = $System->select($sid);
			$this->data = $data;
		}else{
			$this->error('数据错误');
		}
		$this->display();
	}
	
	/* 方法名：		update
	** 方法说明：	更新一条用户信息数据
	** 参数：		无
	** 返回值：		无
	*/
	public function update(){
		$User = D('User');
		if($User->create()) {
			$result =   $User->save();
			if($result) {
				$this->redirect('Admin/User/index');
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($User->getError());
		}
	}

	
}