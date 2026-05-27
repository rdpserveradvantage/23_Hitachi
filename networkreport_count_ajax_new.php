<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); $con = OpenCon();
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
  function lastcommunicationdiff($datetime2){
	    date_default_timezone_set('Asia/Kolkata');
		$datetime1 = new DateTime();
	    $datetime2 = new DateTime($datetime2);
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
		$hour = $elapsedhr;
		if($not>0){
			$return = 0;
		}else{
			if($hour<=24){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }

?>
<?php 
$client = $_POST['client'];
$banks = explode(",",$_SESSION['bankname']);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		   $_bank = explode("_",$banks[$i]);
		   if($client=='All'){
			    array_push($_bank_name,$_bank[1]);
		   }else{
			   if($_bank[0]==$client){
				   array_push($_bank_name,$_bank[1]);
			   }
		   }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
		$_circle_name = "";
		$_circle_name_array = array();
		if($_SESSION['circlename']!=''){
		    $assign_circle = explode(",",$_SESSION['circlename']);
		    $_circle_name = [];
			for($i=0;$i<count($assign_circle);$i++){
			   $_circle = explode("_",$assign_circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			//$_circle_name = $_circle_name_array;
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";

			$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
			while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
					$_circle_name_array[] = $site_circlesql_result['ATMID'];
					
				}
			if(count($_circle_name_array)>0){
				$_circle_name_array1=json_encode($_circle_name_array);
				$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
				$circlearr_atm=explode(',',$_circle_name_array1);
				$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
			}	
		}


 $bank = "";
 $atmid = "";$circle="";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}

/*
$atmidarray = [];
$aisitesql = mysqli_query($con,"select ATMCode from ai_alerts group by ATMCode");
	while($aisitesql_result = mysqli_fetch_assoc($aisitesql)){
		$atmidarray[] = ltrim($aisitesql_result['ATMCode']);
		
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";*/

if($atmid!=''){
	$sql = mysqli_query($con,"select * from network_report_list where atmid='".$atmid."' and live='Y'");
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
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		         $sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
	  
	}else{
		if($client=='All'){
		$sql = mysqli_query($con,"select * from network_report_list where live='Y'");	
		}else{
		$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
	}
	
}
$dvr_online_count = 0;
$dvr_offline_count = 0;
$router_online_count = 0;
$router_offline_count = 0;
$panel_online_count = 0;
$panel_offline_count = 0;

$today = date("Y-m-d H:i");
$_datetime = explode(" ",$today);
$current_date = $_datetime[0];
$current_time = explode(":",$_datetime[1]);
$hh = $current_time[0];
$mm = $current_time[1];


$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;

$dvr_status = 0;
$router_status = 0;
$panel_status = 0;

if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sql_result['ATMID'];
		$_view = 0;
		if(count($_circle_name_array)==0){
			$_view = 1;
		}else{
			if(in_array($atm_id,$_circle_name_array)){
			   $_view = 1;
			}
		}
		if($_view == 1){
			    $router_status = $sql_result['router_status'];
				$dvr_status = $sql_result['dvr_status'];
				$panel_status = $sql_result['panel_status'];
				//$datetime1 = new DateTime();
				
				
				if($router_status>0){
					$router_online_count = $router_online_count + 1;
				}else{
					$router_offline_count = $router_offline_count + 1;	
				}
				
				if($dvr_status>0){
				    $dvr_online_count = $dvr_online_count + 1;
				}else{
				    $dvr_offline_count = $dvr_offline_count + 1;	
				}
				
				if($panel_status>0){
				    $panel_online_count = $panel_online_count + 1;
				}else{
				    $panel_offline_count = $panel_offline_count + 1;	
				}
				
			
		}	
	}
}

$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,
                 'router_online_count'=>$router_online_count,'router_offline_count'=>$router_offline_count,
				 'panel_online_count'=>$panel_online_count,'panel_offline_count'=>$panel_offline_count]);
CloseCon($con);
echo json_encode($array);
?>


