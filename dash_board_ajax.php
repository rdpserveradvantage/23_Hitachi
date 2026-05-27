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

 $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
$con = OpenCon();

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
	$sql = mysqli_query($con,"select * from sites where ATMID='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
		if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."' AND ATMID IN (".$atmidarray.")");
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		         $sql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y' and ATMID IN (".$atmidarray.")");
			}  
	 
	}else{
		$sql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' and ATMID IN (".$atmidarray.")");
	}
	/*$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM sites WHERE ATMID IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql); */
}
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
$total_site = mysqli_num_rows($sql);
if($total_site){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$dvr_online_count = $dvr_online_count + 1;
		$atm_id = $sql_result['ATMID'];
		$aisql = mysqli_query($con,"select File_loc,createtime,receivedtime from ai_alerts where ATMCode like '%".$atm_id."%' ORDER BY id desc LIMIT 1"); 
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
					//if($elapsedhr>0){$not=$not+1;}
					$min = $elapsedmin;
					if($not>0){
						$camera_notworking_count = $camera_notworking_count + 1;
					}else{
						if($elapsedhr<=24){
							$camera_working_count = $camera_working_count + 1;
						}else{
							$camera_notworking_count = $camera_notworking_count + 1;
						}
					}
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;	
				}
			   
			}else{
			   $camera_notworking_count = $camera_notworking_count + 1;	
			}
		}else{
			   $camera_notworking_count = $camera_notworking_count + 1;
		}
	}
}

$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,
                 'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,
				 'hdd_fail_count'=>$hdd_fail_count,'tot'=>$total_site]);
CloseCon($con);
echo json_encode($array);
?>


