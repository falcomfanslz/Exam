<?php
	require_once('../tcpdf.php');
	
// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//$data=$pdf->readfile("p6.pdf");
header("Content-type: application.pdf");
$read=readfile("C.pdf");
$pdf->Write(0, $read, '', 0, 'C', true, 0, false, false, 0);
$pdf->Footer();
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
