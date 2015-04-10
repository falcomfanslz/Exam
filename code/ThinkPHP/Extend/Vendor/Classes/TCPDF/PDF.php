<?php
// just require TCPDF instead of FPDF
require_once('tcpdf/tcpdf.php');
require_once('fpdi/fpdi.php');

class PDF extends FPDI
{

	var $index = 1;//当前打印页数
	var $SchoolName = '';
	var $TeacherName = '';//出题教师姓名
	var $DeanName = '';//系主任姓名
	var $SystemName = '';//系部名称
	var $Year = '';//考试年份
	var $Term = '';//考试学期
	var $Type = '';//考试类型(A/B)

    function Header()
    {
		
    }
    
    function Footer()
    {
		//对页脚的操作
		$this->SetY(-25);
		$this->SetFont('stsongstdlight', '', 10);
		$this->Cell(0, 0, '系（部、中心、教研室）'.$this->SystemName.' 出题教师 '.$this->TeacherName.' 系（部、中心、教研室）主任：'.$this->DeanName, 0, true, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 0, '', 0, true, 'C', 0, '', 0, false, 'T', 'M');
		$this->Cell(0, 0, '第'.$this->getAliasNumPage().'页共'.$this->getAliasNbPages().'页', 0, true, 'C', 0, '', 0, false, 'T', 'M');
    }
	/* 方法名：		edit
	** 方法说明：	显示本学期的课程考试信息
	** 参数：		$path 文件所在路径,$filename 文件保存名称,$SchoolName 学校名称,
					$TeacherName 教师名称,$DeanName 系主任名称,$SystemName 系部名称,
					$Year 考试年份,$Term 考试学期,$Type 考试类型(A/B)
	** 返回值：		无
	*/
	public function edit($path,$filename,$SchoolName,$TeacherName,$DeanName,$SystemName,$Year,$Term,$Type,$CourseName,$ClassName){
		//pdf文件基本信息
		$this->SetMargins(PDF_MARGIN_LEFT, 40, PDF_MARGIN_RIGHT,10);
		$this->SetAutoPageBreak(true, 40);
		$this->setFontSubsetting(false);
		//试卷基本信息赋值
		$this->SchoolName = $SchoolName;
		$this->TeacherName = $TeacherName;
		$this->DeanName = $DeanName;
		$this->SystemName = $SystemName;
		$this->Year = $Year;
		$this->Term = $Term;
		$this->Type = $Type;
		//pdf处理开始
		$pageCount = $this->setSourceFile($path);
		for($i = 1;$i<=$pageCount;$i++){
			$this->addPage();
			$tplIdx = $this->importPage($i, '/MediaBox');
			$this->useTemplate($tplIdx, 0,20,0);//影响正文位置
			//奇数页显示学校名称
			if($i%2==1){
				$this->SetFont('stsongstdlight', 'B', 15);
				$this->SetY(15);
				$this->SetTextColor(0);
				$this->Cell(0, 0, $this->SchoolName,0, true, 'C');
				$this->Cell(0, 0, $this->Year.'学年第'.$this->Term.'学期考试试题'.$this->Type.'卷',0, true, 'C');
			}
			//第一页加上考试科目，时间，分数及班级信息
			if($i==1){
				$this->SetFont('stsongstdlight', '', 13);
				$this->SetX(35);
				$this->Cell(0, 0, '考试科目：'.$CourseName.'   考试时间：100分钟  试卷总分100分',0, true, '');	
				$this->SetX(35);
				$this->Cell(0, 0, '考试班级：'.$ClassName,0, true, '');
			}
		}
		//pdf文件输出
		$this->Output($filename,'d');
	}
}