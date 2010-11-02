<?php
/** PHPExcel */
function export_xls($value,$col_name=null,$file_name,$title){
error_reporting(E_ALL);
require_once SRVROOT.'/cms/lib/php_excel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
$row_num = 0;
$col_num = "A";
foreach($col_name as $cols){
	$row_num++;
	$col_num = "A";
	foreach($cols as $key => $val ){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($col_num++.$row_num, $val);		
	}
}

foreach($value as $rows){
	$row_num++;
	$col_num = "A";
	foreach($rows as $key => $val ){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue($col_num++.$row_num, $val);		
	}
}
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle($title);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$file_name.'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
}
?>