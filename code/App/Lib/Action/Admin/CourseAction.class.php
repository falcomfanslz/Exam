<?php
/* 类名：		CourseAction
** 类说明：		关于管理员操作课程信息的所有方法
** 位置：		Action/Admin
** 作者：		李卓
** 更新时间： 	2015/1/12
** 更新原因：	第一次写入
*/
class CourseAction extends Action {
	/* 方法名：		index
	** 方法说明：	显示课程设计操作主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Courseview = D('Courseview'); // 实例化Data数据模型	 
		$this->data = $Courseview->select();
		$this->display();
    }
	
	/* 方法名：		add
	** 方法说明：	添加一条课程信息的准备步骤
	** 参数：		无
	** 返回值：		无
	*/
    public function add(){
		$System = D('System'); // 实例化Data数据模型	 
		$this->system = $System->select();
		$this->display();
    }
	
	/* 方法名：		insert
	** 方法说明：	向数据库插入一条课程信息
	** 参数：		无
	** 返回值：		无
	*/
	public function insert(){
		$Course = D('Course');
        if($Course->create()) {
			$result = $Course->add($Course->id);
			if($result) {
				$this->redirect('Admin/Course/index');
			}else{
				$this->error('写入错误！');
			}
        }else{
            $this->error($Course->getError());
        }
	}
	
	/* 方法名：		edit
	** 方法说明：	把一条课程设计数据读取出来，以便修改
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function edit($id = -1){
		if($id == -1) $this->redirect('Admin/Course/index');//保护
		$Course = D('Course');
		$System = D('System');
		$data=$Course->find($id);
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
	** 方法说明：	更新一条课程信息数据
	** 参数：		无
	** 返回值：		无
	*/
	public function update(){
		$Course = D('Course');
		if($Course->create()) {
			$result =   $Course->save();
			if($result) {
				$this->redirect('Admin/Course/index');
			}else{
				$this->error('写入错误！');
			}
		}else{
			$this->error($Course->getError());
		}
	}
	
	/* 方法名：		delete
	** 方法说明：	删除一条课程信息数据（未完成，不完整）
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function delete($id = -1){
		if($id == -1) $this->redirect('Admin/Course/index');//保护
		$Course = D('Course');
		$result=$Course->delete($id);
		if($result) {
			$this->redirect('Admin/Course/index');
		}else{
			$this->error('删除错误！');
		}
	}
	
	/* 方法名：		view
	** 方法说明：	查看一条课程信息数据（未完成，不完整）
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function view($id = -1){
	}
}