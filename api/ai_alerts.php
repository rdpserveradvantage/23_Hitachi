<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); 
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
?>
<?php 
$client = $_POST['client'];
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
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

   $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}

$atmidarray = [];
$aisitesql = mysqli_query($con,"select ATMCode from ai_alerts group by ATMCode");
	while($aisitesql_result = mysqli_fetch_assoc($aisitesql)){
		$atmidarray[] = ltrim($aisitesql_result['ATMCode']);
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";

if($atmid!=''){
	$sql = mysqli_query($con,"select * from sites where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
	  $sql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y' and ATMID IN (".$atmidarray.")");
	}else{
		$sql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' and ATMID IN (".$atmidarray.")");
	}
	
}
    /*
    $newatmidarray = [];
	while($newsitesql_result = mysqli_fetch_assoc($sql)){
		$newatmidarray[] = $newsitesql_result['ATMID'];
		
	}
	$newatmidarray=json_encode($newatmidarray);
	$newatmidarray=str_replace( array('[',']','"') , ''  , $newatmidarray);
	$newarr=explode(',',$newatmidarray);
	$newatmidarray = "'" . implode ( "', '", $newarr )."'";
	
	$testsql = "SELECT * FROM sites WHERE ATMID IN (".$newatmidarray.")";
    $sql = mysqli_query($con,$testsql);  */

$dvr_online_count = 0;
$dvr_offline_count = 0;

$today = date("Y-m-d H:i");
$_datetime = explode(" ",$today);
$current_date = $_datetime[0];
$current_time = explode(":",$_datetime[1]);
$hh = $current_time[0];
$mm = $current_time[1];


$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
$res_data = [];
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$dvr_online_count = $dvr_online_count + 1;
		$atm_id = $sql_result['ATMID'];
		$aisql = mysqli_query($con,"select * from ai_alerts where ATMCode like '%".$atm_id."%' ORDER BY id desc LIMIT 10"); 
		if(mysqli_num_rows($aisql)>0){
			$aisql_result = mysqli_fetch_assoc($aisql);
			$createdatetime = $aisql_result['createtime'];
			if($aisql_result['File_loc']!=''){
				if($createdatetime!=''){
					$datetime1 = new DateTime();
					$datetime2 = new DateTime($createdatetime);
					$interval = $datetime1->diff($datetime2);
					
					$elapsedyear = $interval->format('%y');
					$elapsedmon = $interval->format('%m');
					$elapsed_day = $interval->format('%a');
					$elapsedhr = $interval->format('%h');
					$elapsedmin = $interval->format('%i');
					$not = 0;
					if($elapsedyear>0){$not=$not+1;}
					if($elapsedmon>0){$not=$not+1;}
					if($elapsed_day>0){$not=$not+1;}
					if($elapsedhr>0){$not=$not+1;}
					$min = $elapsedmin;
					if($not>0){
						$camera_notworking_count = $camera_notworking_count + 1;
					}else{
						if($min<=30){
							$ai_id = $aisql_result['id'];
							$ai_panelid =$aisql_result['panelid'];
							$ai_atmid = $aisql_result['ATMCode'];
							$ai_File_loc = $aisql_result['File_loc'];
							$DateTime = trim($aisql_result['createtime']);
							$ai_alerttype = $aisql_result['alerttype'];

							if(strpos($ai_alerttype,'-'===0)){

								$alerttype_ar = explode("-",$ai_alerttype);
								$alerttype_ar = $alerttype_ar[0] . ' Person/s <br>' . $alerttype_ar[1] . ' Animal/s' ;
							}else{
								$alerttype_ar = $ai_alerttype;
							}

							$date = substr($DateTime, 0, 10);

							$time = substr($DateTime, 11, 18);
							$time = str_replace("-", ":", $time);

							 $datetime = $date. ' ' . $time ; 
							 $datetime = date('Y-m-d h:i:s a', strtotime($datetime));

							 $src = "";
								if($ai_File_loc!=''){
									//$files = explode("/",$str);
									$files = str_replace('./Record','',$ai_File_loc);
									//$file = $files[2];
									$file = str_replace('/','\\',$files);
									$path = "D:\\python_codes\\Server_socket\\Record\\$file";
									if(file_exists($path)){
										$imgData = base64_encode(file_get_contents($path)); 
										$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
									}
								}
							$_data = [];	
							$_data['id'] = $ai_id; 
							$_data['atmid'] = $ai_atmid;
							$_data['datetime'] = $datetime;
							$_data['src'] = $src;
							$_data['alert_name'] = $alerttype_ar;
							array_push($res_data,$_data);
							
						}
					}
				}
			   
			}
		}
	}
}

if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>


