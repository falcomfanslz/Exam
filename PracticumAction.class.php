<?php
/* 类名：		PracticumAction
** 类说明：		关于学生查询课程设计的所有方法
** 位置：		Action/Student
** 作者：		李卓
** 更新时间： 	2015/1/2
** 更新原因：	第一次写入
*/
class PracticumAction extends CheckAction {
	/* 方法名：		index
	** 方法说明：	显示课程设计操作主页
	** 参数：		无
	** 返回值：		无
	*/
    public function index(){
		$Practicum = D('Practicumview'); // 实例化Data数据模型	 
		Vendor('Classes.Page');
		$count = $Practicum->count();// 查询满足要求的总记录数
		$Page = new Page($count,25);// 实例化分页类 传入总记录数和每页显示的记录数
		$show = $Page->show();// 分页显示输出
		//进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$data = $Practicum->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('data',$data);// 赋值数据集
		$this->assign('show',$show);// 赋值分页输出
		$this->assign('count',$count);// 总数量
		$this->display();
    }

	/* 方法名：		view
	** 方法说明：	查看一条课程设计信息数据
	** 参数：		$id 课程设计编号
	** 返回值：		无
	*/
	public function view($id = -1){
		if($id == -1) $this->redirect('Student/Practicum/index');//保护
		$username = session('username');
		$Practicum = D('Practicumview');
		$data=$Practicum->find($id);
		$this->data = $data;// 模板变量赋值
		$Project = D('Spview');
		$project = $Project->where("prcId=$id and sid=$username")->find();
		//查看当前学生在这个课程设计中是否有项目
		if($project){
			$button['link'] = 'view/id/'.$project['pid'];
			$button['img'] = 'ico01.png';
			$button['name'] = '查看项目'; 
		}else{
			$button['link'] = 'add';
			$button['img'] = 'ico02.png';
			$button['name'] = '创建新项目';
		}
		$this->button = $button;
		session('practicumData',$data);//储存课程设计信息
		$this->display();
	}
}
