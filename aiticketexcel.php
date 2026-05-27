<?php

ini_set('max_execution_time', 0);
    set_time_limit(0) ;
session_start();
include('db_connection.php'); 
$con = OpenCon();
$client=$_POST['excel_client'];
$bank=$_POST['excel_bank'];
$circle=$_POST['excel_circle'];
$atmid=$_POST['excel_atmid'];
$portal=$_POST['excel_portal'];
$start=$_POST['excel_start'];
$end=$_POST['excel_end'];
$ticket_ids=$_POST['ticket_ids'];
$app = explode(",",$ticket_ids);
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
$objSheet->setTitle('AI Ticket Excel');


$objSheet->setCellValue('A1', 'TicketNo');

$objSheet->getStyle('A1')->applyFromArray($styleArray);
$objSheet->setCellValue('B1', 'Location');
$objSheet->getStyle('B1')->applyFromArray($styleArray);
$objSheet->setCellValue('C1', 'BranchCode');
$objSheet->getStyle('C1')->applyFromArray($styleArray);
$objSheet->setCellValue('D1', 'AlertType');
$objSheet->getStyle('D1')->applyFromArray($styleArray);
$objSheet->setCellValue('E1', 'TicketDateTime');
$objSheet->getStyle('E1')->applyFromArray($styleArray);
$objSheet->setCellValue('F1', 'DVR IP');
$objSheet->getStyle('F1')->applyFromArray($styleArray);


$objSheet->setCellValue('G1', 'Alarm Status');
$objSheet->getStyle('G1')->applyFromArray($styleArray);
/*
$chexcelsql="select filename from mis_salary_fund_transfer_excel_test where trans_id=".$trans_id;
$chexceltable=mysqli_query($con,$chexcelsql); 
if(mysqli_num_rows($chexceltable)>0){
    $chexcelrowdata=mysqli_fetch_row($chexceltable);
     $filename = $chexcelrowdata[0];
     
}else{
    $excelsql="select id from mis_salary_fund_transfer_excel_test order by id desc";
    $exceltable=mysqli_query($con,$excelsql); 
    if(mysqli_num_rows($exceltable)>0){
      $excelrowdata=mysqli_fetch_row($exceltable);
      $n = $excelrowdata[0];
      $n = $n + 1;
    }else{
      $n = 1;
    }
    
    
    $joindate = date('dmY');
    $filename = "CS".$n.$joindate;
    
    $insertexcelsql = "insert into mis_salary_fund_transfer_excel_test(filename,trans_id) 
                            values('".$filename."','".$trans_id."')";
                    mysqli_query($con,$insertexcelsql);
}
*/
$filename = "AITicketReport";
$srn=1;
$row = 2;
$dt=date('d-m-Y');
$condt = strtotime($dt);
$today = date('d-M-Y');
$today = strtoupper($today);
$mnth=date('M-Y');


$banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($_bank[0]==$client){
			   array_push($_bank_name,$_bank[1]);
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";

    if($atmid!=''){
		$sitesql = mysqli_query($con,"select ATMID from sites where ATMID='".$atmid."' and live='Y'");
	}else{
		if($bank!=''){
			if($circle!=''){
					$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
					$circleatmidarray = [];
					while($circlesql_result = mysqli_fetch_assoc($circlesql)){
						$circleatmidarray[] = $circlesql_result['ATMID'];
						
					}
					$circleatmidarray=json_encode($circleatmidarray);
					$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
					$circlearr=explode(',',$circleatmidarray);
					$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
				}else{ 
					 $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				} 
		 
		}else{
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
	}
	$atmidarray = [];
while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = " ".$sitesql_result['ATMID'];
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}

if($portal=="all"){
$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"); 
}else{
	if($portal=="active"){
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 
	}else{
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 
	}
}                                                   
				$total=0;$i = 0 ;
		if(mysqli_num_rows($sql)>0){
		  while($sql_result = mysqli_fetch_assoc($sql)){ 
					$_atmid = trim($sql_result['ATMCode']);
					$_dvrip = "-";
					$_siteaddress = "-";
					$atmsitesql = mysqli_query($con,"select id,ATMID,DVRIP,SiteAddress from sites where ATMID='".$_atmid."'");
					if(mysqli_num_rows($atmsitesql)>0){
					  $atmsitesql_result = mysqli_fetch_assoc($atmsitesql);
					  $_siteaddress = $atmsitesql_result['SiteAddress'];
					  $_dvrip = $atmsitesql_result['DVRIP'];
					}
					$alert_type = $sql_result['alerttype'];
                    $create_time = $sql_result['createtime'];
                    $_status = 'Closed';
					if($sql_result['status']=='O'){
						$_status = 'Active';
					}	
                    $ticket_id = $sql_result['id'];					
              
$bl="";
/*
$objSheet->setCellValueExplicitByColumnAndRow(0, $row, '345005000122',PHPExcel_Cell_DataType::TYPE_STRING);
$objSheet->setCellValueExplicitByColumnAndRow(1, $row, $rowdata[10],PHPExcel_Cell_DataType::TYPE_STRING);
$objSheet->setCellValueByColumnAndRow(2, $row, $rowdata[8]);
$objSheet->setCellValueByColumnAndRow(3, $row, $_customer_total_amt);
$objSheet->setCellValueExplicitByColumnAndRow(4, $row, $paymode);
$objSheet->setCellValueByColumnAndRow(5, $row,$today);
$objSheet->setCellValueByColumnAndRow(6, $row,$string_n);
$objSheet->setCellValueExplicitByColumnAndRow(7, $row,$bl); */
$objSheet->setCellValueExplicitByColumnAndRow(0, $row, $ticket_id,PHPExcel_Cell_DataType::TYPE_STRING);
$objSheet->setCellValueByColumnAndRow(1, $row, $_siteaddress);
$objSheet->setCellValueByColumnAndRow(2, $row,$_atmid);
$objSheet->setCellValueByColumnAndRow(3, $row, $alert_type);
$objSheet->setCellValueByColumnAndRow(4, $row, $create_time);
$objSheet->setCellValueByColumnAndRow(5, $row,$_dvrip);
$objSheet->setCellValueByColumnAndRow(6, $row, $_status);

 $row++;
$srn++;

}
		}
for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet()->getHighestColumn(); $i++) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setAutoSize(TRUE);
}
/*
$objSheet->getProtection()->setPassword('pass_to_remove_protection');
$objSheet->getProtection()->setSheet(true);
$objSheet->getStyle('B2:J5')->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_PROTECTED); */

 header("Content-Disposition: attachment; filename=".$filename.".xlsx");
 header("Content-Type: application/vnd.ms-excel");

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 



$objWriter->save("php://output",'r');

?>