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
//$client = "Hitachi";
$client = $_POST['client'];
//$reportType = "Weekly";
$reportType = $_POST['report'];
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

//$bank = "PNB";$circle = "MUMBAI CITY";

if($reportType=='Daily'){
	$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
}
if($reportType=='Hourly'){
	$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 3 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
}
if($reportType=='Weekly'){
	$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 168 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
}
if($reportType=='Monthly'){
	$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 720 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
}

//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	//$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where atmid='".$atmid."' and live='Y'";
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.ATMID='".$atmid."' and s.live='Y'";
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
				//$sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";	
			    $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			}else{
		         $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
			} 
	  
	}else{
		if($client=='All'){
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'";
		  // $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where live='Y'";	
		}else{
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'";
		 //  $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}
//echo $sql_qry;die;

 $sql = mysqli_query($con,$sql_qry); 

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
			$site_address = $sql_result['SiteAddress'];
			$atm_id = $sql_result['ATMID'];
			$dvrip = $sql_result['DVRIP'];
			$panelip = $sql_result['PanelIP'];
			$routerip = $sql_result['RouterIp'];
			$sn = $sql_result['SN'];
			$device_count = $sql_result['device_count'];
			
			$router_status_total = 0;
			$router_status_online = 0;
			$dvr_status_total = 0;
			$dvr_status_online = 0;
			$panel_status_total = 0;
			$panel_status_online = 0;
			$dvronlinepercent = 0;
			$routeronlinepercent = 0;
			$panelonlinepercent = 0;
			
			if(is_null($device_count)){
				$dvr_offline_count = $dvr_offline_count + 1;
				$panel_offline_count = $panel_offline_count + 1;
				$router_offline_count = $router_offline_count + 1;
			}else{
				$comma_separator = explode(",",$device_count);
				$is_dvr = 0;$is_panel = 0;$is_router = 0;
				for($i=0;$i<count($comma_separator);$i++){
					
					$_separator = explode("_",$comma_separator[$i]);
					if($_separator[0]=='D'){
						$is_dvr = 1;
						if($_separator[1]>=1){
							$dvr_online_count = $dvr_online_count + 1;
						}else{
							$dvr_offline_count = $dvr_offline_count + 1;
						}
					}elseif($_separator[0]=='P'){
						$is_panel = 1;
						if($_separator[1]>=1){
							$panel_online_count = $panel_online_count + 1;
						}else{
						    $panel_offline_count = $panel_offline_count + 1;
						}
						
					}else{
						$is_router = 1;
						if($_separator[1]>=1){
							$router_online_count = $router_online_count + 1;
						}else{
						    $router_offline_count = $router_offline_count + 1;
						}
						
					}
					
				}
				
				
				if($is_dvr==0){
					$dvr_offline_count = $dvr_offline_count + 1;
				}
				if($is_panel==0){
					$panel_offline_count = $panel_offline_count + 1;
				}
				if($is_router==0){
					$router_offline_count = $router_offline_count + 1;
				}
				
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


