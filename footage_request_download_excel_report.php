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
$objSheet->setTitle('Multiple Footage Request');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objSheet->setCellValue('A1', 'IP');
$objSheet->getStyle('A1')->applyFromArray($styleArray);
$objSheet->setCellValue('B1', 'Cam Number');
$objSheet->getStyle('B1')->applyFromArray($styleArray);
$objSheet->setCellValue('C1', 'From DateTime');
$objSheet->getStyle('C1')->applyFromArray($styleArray);
$objSheet->setCellValue('D1', 'To DateTime');
$objSheet->getStyle('D1')->applyFromArray($styleArray);
$objSheet->setCellValue('E1', 'PC Number');
$objSheet->getStyle('E1')->applyFromArray($styleArray);

$srn=1;
$row = 2;
$filename = "Download_Multiple_Footage_Request_Excel";
                              $con = OpenCon();                     
						$sql="select * from footage_request where footage_avail='No'";
						$view = 0; 
						$table=mysqli_query($con,$sql);    
						 
						   while($accr=mysqli_fetch_assoc($table)){
							   $atmid = $accr['atmid'];
							   $get_ip = mysqli_query($con,"select DVRIP from sites where ATMID='".$atmid."' ");
							   $get_ip_data= mysqli_fetch_row($get_ip);
							   $ip = $get_ip_data[0];
							   $blank = "";
							   $txn_date = $accr['date_of_TXN'];
							   $strt_time = $accr['start_time'];
							   $end_time = $accr['end_time'];
							   $from_time = $txn_date." ".$strt_time;
							   $to_time = $txn_date." ".$end_time;
							   $objSheet->setCellValueExplicitByColumnAndRow(0, $row, $ip,PHPExcel_Cell_DataType::TYPE_STRING);
							   $objSheet->setCellValueExplicitByColumnAndRow(1, $row, $blank,PHPExcel_Cell_DataType::TYPE_STRING);
                               $objSheet->setCellValueExplicitByColumnAndRow(2, $row, $from_time,PHPExcel_Cell_DataType::TYPE_STRING);
							   $objSheet->setCellValueExplicitByColumnAndRow(3, $row, $to_time,PHPExcel_Cell_DataType::TYPE_STRING);
							   $objSheet->setCellValueExplicitByColumnAndRow(4, $row, $blank,PHPExcel_Cell_DataType::TYPE_STRING);
							   $row++;
							   $srn++;
							}
CloseCon($con);
/*
$objSheet->getProtection()->setPassword('pass_to_remove_protection');
$objSheet->getProtection()->setSheet(true);
$objSheet->getStyle('B2:J5')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED); */

 header("Content-Disposition: attachment; filename=".$filename.".xlsx");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007'); 
$objWriter->save("php://output",'r');

?>