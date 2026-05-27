<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');

?>
<?php 
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
function lastcommunicationdiff($datetime1,$datetime2){
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

//$client = "Hitachi";
$client = $_POST['client'];
$userid = $_POST['user_id'];

//$client = 'Hitachi';
//$userid = 24;

$con = OpenCon();
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
	$_circle_name = "";
		$_circle_name_array = array();
		if($_circle_ids!=''){
		    $assign_circle = explode(",",$_circle_ids);
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
	//$device = 'D';
	//$status = 0;
	$device = $_POST['device'];
    $status = $_POST['status'];

//$bank = "PNB";
$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	if($device=='D'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND dvr_status='".$status."' AND live='Y'"); 
	}
	if($device=='P'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND panel_status='".$status."' AND live='Y'");
	}
	if($device=='R'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND router_status='".$status."' AND live='Y'");
	}			 
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
			if($device=='D'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."' AND live='Y'"); 
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.")  AND panel_status='".$status."' AND live='Y'");
			}
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.")  AND router_status='".$status."' AND live='Y'");
			} 
		}else{
			if($device=='D'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' AND dvr_status='".$status."' AND live='Y'"); 
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' AND panel_status='".$status."' AND live='Y'");
			}
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' AND router_status='".$status."' AND live='Y'");
			} 
		} 
	  
	}else{
		if($client=='All'){
			if($device=='D'){
				$sql = mysqli_query($con,"select * from network_report_list where dvr_status='".$status."' AND live='Y'"); 
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where panel_status='".$status."' AND live='Y'");
			}
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where router_status='".$status."' AND live='Y'");
			} 
		}else{
			if($device=='D'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank IN (".$_bank_name.") AND dvr_status='".$status."' AND live='Y'"); 
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank IN (".$_bank_name.") AND panel_status='".$status."' AND live='Y'");
			}
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank IN (".$_bank_name.") AND router_status='".$status."' AND live='Y'");
			} 	 
		}
	}
	
}
//echo $sql_qry;die;

 //$sql = mysqli_query($con,$sql_qry); 

 $yesterday = date('Y-m-d',strtotime("-1 days"));
						
                        $count = 0; $_data = [];
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
									$site_address = htmlspecialchars($sql_result['SiteAddress']);
									$atm_id = $sql_result['ATMID'];
									$dvrip = $sql_result['dvr_ip'];
									$panelip = $sql_result['panel_ip'];
									$routerip = $sql_result['router_ip'];
									$sn = $sql_result['SN'];
									
											$count++;
											
											$dvr_status = 0;
											$router_status = 0;
											$panel_status = 0;
											
																					
											$router_status_total = 0;
											$router_status_online = 0;
											$dvr_status_total = 0;
											$dvr_status_online = 0;
											$panel_status_total = 0;
											$panel_status_online = 0;
											$dvronlinepercent = 0;
											$routeronlinepercent = 0;
											$panelonlinepercent = 0;
											
											$will_update = 0;
											$is_networksql = 0;
											
											$tb_id = $sql_result['id'];
											$tb_last_action_date = $sql_result['last_action_date'];
											$router_status_total = $sql_result['router_tot_count'];
											$router_status_online = $sql_result['router_online_count'];
											$dvr_status_total = $sql_result['dvr_tot_count'];
											$dvr_status_online = $sql_result['dvr_online_count'];
											$panel_status_total = $sql_result['panel_tot_count'];
											$panel_status_online = $sql_result['panel_online_count'];
											
											$routerlast_communication = $sql_result['router_lastcommunication'];
											$dvrlast_communication = $sql_result['dvr_lastcommunication'];
											$panellast_communication = $sql_result['panel_lastcommunication'];
											
											 $router_status = $sql_result['router_status'];
											$dvr_status = $sql_result['dvr_status'];
											$panel_status = $sql_result['panel_status'];
										
										
										if($dvr_status_total>0){
											$dvronlinepercent = ($dvr_status_online/$dvr_status_total)*100;
											$dvronlinepercent = number_format((float)$dvronlinepercent, 2, '.', '');
										}
										if($panel_status_total>0){
											$panelonlinepercent = ($panel_status_online/$panel_status_total)*100;
											$panelonlinepercent = number_format((float)$panelonlinepercent, 2, '.', '');
										}
										if($router_status_total>0){
											$routeronlinepercent = ($router_status_online/$router_status_total)*100;
											$routeronlinepercent = number_format((float)$routeronlinepercent, 2, '.', '');
										} 			
                                        
										$key_status = 0;
										if($count%10==0){
											$key_status = 1;
										}
										
										$data_arr = [];
										$data_arr['atm_id'] = $atm_id;
										$data_arr['site_address'] = $site_address;
										if($router_status>0){$router_status_value= 'Online';}else{$router_status_value= 'Offline';}
										$data_arr['router_status'] = $router_status_value;
										$data_arr['routerip'] = $routerip;
										$data_arr['routerlast_communication'] = $routerlast_communication;
										$data_arr['routeronlinepercent'] = $routeronlinepercent;
										if($dvr_status>0){$dvr_status_value= 'Online';}else{$dvr_status_value= 'Offline';}
										$data_arr['dvr_status'] = $dvr_status_value;
										$data_arr['dvrip'] = $dvrip;
										$data_arr['dvrlast_communication'] = $dvrlast_communication;
										$data_arr['dvronlinepercent'] = $dvronlinepercent;
										if($panel_status>0){$panel_status_value= 'Online';}else{$panel_status_value= 'Offline';}
										$data_arr['panel_status'] = $panel_status_value;
										$data_arr['panelip'] = $panelip;
										$data_arr['panellast_communication'] = $panellast_communication;
										$data_arr['panelonlinepercent'] = $panelonlinepercent;
										$data_arr['key_status'] = $key_status;
										array_push($_data,$data_arr);  	
										
									
							   
						  }
					   }
					 }
			  $array = array(['count'=>$count,'res_data'=>$_data]);
					CloseCon($con);
					echo json_encode(utf8ize($array));
			?>
                      

