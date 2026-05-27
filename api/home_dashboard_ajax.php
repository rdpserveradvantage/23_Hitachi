<?php 
 include('db_connection.php'); 
 $con = OpenCon(); 

 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) { 
        return utf8_encode($d);
    }
    return $d;
}
 //$client = 'Hitachi';
 //$userid = 24;
$client = $_POST['client'];
$userid = $_POST['user_id'];
$usersql = mysqli_query($con,"select cust_id,bank_id,circle_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
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
	
	
	$_circle_ids = $userdata['circle_id'];
	if($_circle_ids!=''){
        $circles = explode(",",$_circle_ids);
        $_circle_name = [];
        for($i=0;$i<count($circles);$i++){
		   $_circle = explode("_",$circles[$i]);
		   if(count($_circle)>0){
			   array_push($_circle_name,$_circle[1]);
		   }
	    } 
	   
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";
	}

$bank = $_POST['bank'];
 //$bank = "PNB";

    if($_circle_ids!=''){
			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
            while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
				$_circle_name_array[] = $site_circlesql_result['ATMID'];
				
			}	
			$circleatmidarray=json_encode($_circle_name_array);
			$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
			$circlearr=explode(',',$circleatmidarray);
			$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
			$query = "SELECT * FROM sites WHERE Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.")";
			$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.ATMID IN (".$circleatmidarray.") and a_s.live='Y' ORDER BY aaa.id DESC";
	        $dvr_qry = "SELECT * FROM `dvr_health` WHERE SN IN (SELECT SN FROM sites WHERE Customer='".$client."' AND Bank='".$bank."' AND ATMID IN (".$circleatmidarray.") AND live='Y') AND status=0 AND hdd IS NOT NULL AND hdd!='ok' AND hdd!='OK'";
	        $dvr_fault_qry = "SELECT * FROM call_log_dvr_alerts WHERE ATMID IN (".$circleatmidarray.")";
			$camera_fault_qry = "SELECT * FROM call_log_camera_alerts WHERE ATMID IN (".$circleatmidarray.")";
	}else{ 
		$query = "SELECT * FROM sites WHERE Customer='".$client."' and Bank='".$bank."'";
		$query1 = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
		$dvr_qry = "SELECT * FROM `dvr_health` WHERE SN IN (SELECT SN FROM sites WHERE Customer='".$client."' AND Bank='".$bank."' AND live='Y') AND status=0 AND hdd IS NOT NULL AND hdd!='ok' AND hdd!='OK'";	
	    $dvr_fault_qry = 'SELECT * FROM call_log_dvr_alerts';
		$camera_fault_qry = 'SELECT * FROM call_log_camera_alerts';
	} 
	//echo $query;die;
	$sql = mysqli_query($con,$query);
	// echo mysqli_num_rows($sql);
    $count = 1 ; $site_working = 0; $site_notworking=0;$total_site=0; 
	$_data = [];
	$code = 201;
	$totalsite = mysqli_num_rows($sql); 
    if($totalsite>0){
	   
		while($sql_result = mysqli_fetch_assoc($sql)){
			$total_site = $total_site + 1;
            $live = $sql_result['live'];
			if($live=='Y'){
				$site_working = $site_working + 1;
			}else{
				$site_notworking=$site_notworking+1;
			}
		   	
		}
		$code = 200;
	}
	
	//$aisql = mysqli_query($con,$query1);
	// 
    $count = 1 ; $camera_notworking_count = 0; $camera_working_count=0;
	$_data = [];  $ai_total_site = 0;
	/*
	$ai_total_site = mysqli_num_rows($aisql); 
    if($ai_total_site>0){
	    while($ai_sql_result = mysqli_fetch_assoc($aisql)){
			$ticket_id = $ai_sql_result['ID'];
	        if($ticket_id){
				$camera_working_count = $camera_working_count + 1;
			}else{
			   $camera_notworking_count = $camera_notworking_count + 1;
		    }
		}
		
	}
     */
	 
	 /*
	$dvr_sql = mysqli_query($con,$dvr_qry);
	$hdd_fault = mysqli_num_rows($dvr_sql);
	
    $hdd_status_qry = mysqli_query($con,$dvr_fault_qry);
	
	$hdd_fault_status = mysqli_num_rows($hdd_status_qry);

	$count=1; $hdd_fault_open=0; $hdd_fault_close=0;

	if($hdd_fault_status>0){
		while($hdd_sql_result = mysqli_fetch_assoc($hdd_status_qry)){
			$curr_status = $hdd_sql_result['current_status'];
			if($curr_status==1){
				$hdd_fault_close = $hdd_fault_close + 1; 
			} else {
				$hdd_fault_open = $hdd_fault_open + 1;
			}
		}
	}
	
	$camera_status_qry = mysqli_query($con,$camera_fault_qry);
	
	$camera_fault_status = mysqli_num_rows($camera_status_qry);

	$count=1; $camera_fault_open=0; $camera_fault_close=0;

	if($camera_fault_status>0){
		while($camera_sql_result = mysqli_fetch_assoc($camera_status_qry)){
			$camcurr_status = $camera_sql_result['current_status'];
			if($camcurr_status==1){
				$camera_fault_close = $camera_fault_close + 1; 
			} else {
				$camera_fault_open = $camera_fault_open + 1;
			}
		}
	}  */

/*	
$array = array(['code'=>$code,'total_site'=>$total_site,'site_working'=>$site_working,'site_notworking'=>$site_notworking
,'ai_total_site'=>$ai_total_site,'ai_site_working'=>$camera_working_count,'ai_site_notworking'=>$camera_notworking_count,
'hdd_fault'=>$hdd_fault_status,'hdd_working'=>$hdd_fault_close,'hdd_notworking'=>$hdd_fault_open,
'camera_fault'=>$camera_fault_status,'camera_working'=>$camera_fault_close,'camera_notworking'=>$camera_fault_open]);
*/

$array = array(['code'=>$code,'total_site'=>$total_site,'site_working'=>$site_working,'site_notworking'=>$site_notworking
]);


CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>