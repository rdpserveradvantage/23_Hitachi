<?php
ini_set('max_execution_time', 0);
    set_time_limit(0) ;
include('db_connection.php');
require_once 'Classes/PHPExcel.php';
require_once "Classes/PHPExcel/IOFactory.php";
include_once 'Classes/PHPExcel/Writer/Excel5.php';
// create new PHPExcel object
$objPHPExcel = new PHPExcel();
 
ini_set('memory_limit', '-1');
//Prevent your script from timing out

// This increases the excution time from 30 secs to 3000 secs.
//set_time_limit ( 3000 ); 

$styleArray = array(
    'font'  => array(
        //'bold'  => true,
        'color' => array('rgb' => 'FF0000'),
       // 'size'  => 15,
       // 'name'  => 'Verdana'
    ));
    
// writer already created the first sheet for us, let's get it
$objSheet = $objPHPExcel->getActiveSheet();

// rename the sheet
$objSheet->setTitle('Download Image ATMID Excel');


$objSheet->setCellValue('A1', 'ATMID');

$objSheet->getStyle('A1')->applyFromArray($styleArray);
$objSheet->setCellValue('B1', 'Status');
$objSheet->getStyle('B1')->applyFromArray($styleArray);

$srn=1;
$row = 2;
$filename = "Download_Zip_Image_Excel";
                              $con = OpenCon();                     
						$sql="select * from download_zip_excel";
						$view = 0; 
						$table=mysqli_query($con,$sql);    
						 
						   while($accr=mysqli_fetch_assoc($table)){
							   $atmid = $accr['atmid'];
							   $status = $accr['status'];
							   $objSheet->setCellValueExplicitByColumnAndRow(0, $row, $atmid,PHPExcel_Cell_DataType::TYPE_STRING);
							   $objSheet->setCellValueExplicitByColumnAndRow(1, $row, $status,PHPExcel_Cell_DataType::TYPE_STRING);

							   $row++;
							   $srn++;
							}
CloseCon($con);

$objSheet->getProtection()->setPassword('pass_to_remove_protection');
$objSheet->getProtection()->setSheet(true);
$objSheet->getStyle('B2:J5')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED);

 header("Content-Disposition: attachment; filename=".$filename.".xls");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 
$objWriter->save("php://output",'r');

?>