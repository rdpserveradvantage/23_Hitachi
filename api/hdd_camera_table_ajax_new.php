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
	//$device = $_POST['device'];
    $status = $_POST['status'];
	$call_log_type = $_POST['call_log_type'];

//$bank = "PNB";
$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	if($status=='All'){
		if($call_log_type=='hdd'){
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."'";
			
		}else{
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."'";
			
		}
		
	}
	if($status=='Open'){
		if($call_log_type=='hdd'){
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."' AND c.current_status=0";
		}else{
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."' AND c.current_status=0";
		}
	}
	if($status=='Close'){
		if($call_log_type=='hdd'){
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."' AND c.current_status=1";
		}else{
			$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.ATMID='".$atmid."' AND c.current_status=1";
		}
		
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
			if($status=='All'){
				if($call_log_type=='hdd'){
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.")";
				}else{
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.")";
				}
			}
			if($status=='Open'){
				if($call_log_type=='hdd'){
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") AND c.current_status=1";
				}else{
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") AND c.current_status=1";
				}
			}
			if($status=='Close'){
			    if($call_log_type=='hdd'){
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") AND c.current_status=0";
				}else{
					$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") AND c.current_status=0";
				}	
			} 
		}else{
			if($_circle_ids!=''){
				if($status=='All'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.")";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.")";
					}
				}
				if($status=='Open'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.") AND c.current_status=0";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.") AND c.current_status=0";
					}
				}
				if($status=='Close'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.") AND c.current_status=1";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$_circle_name_array1.") AND c.current_status=1";
					}
				} 
			}else{
				if($status=='All'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."'";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."'";
					}
				}
				if($status=='Open'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' AND c.current_status=0";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' AND c.current_status=0";
					}
				}
				if($status=='Close'){
					if($call_log_type=='hdd'){
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,c.ticket_id  FROM `sites` s join call_log_dvr_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' AND c.current_status=1";
					}else{
						$sql_qry = "SELECT s.*,c.current_status,c.id AS cl_id,ticket_id  FROM `sites` s join call_log_camera_alerts c ON c.ATMID=s.ATMID WHERE s.Customer='".$client."' and s.Bank='".$bank."' AND c.current_status=1";
					}
				} 
			}
			
		} 
	  
	}else{
		if($client=='All'){
			if($status=='All'){
				$sql = mysqli_query($con,"select * from sites"); 
			}
			if($status=='Online'){
				$sql = mysqli_query($con,"select * from sites where live='Y'");
			}
			if($status=='Offline'){
				$sql = mysqli_query($con,"select * from sites where live!='Y'");
			} 
			
		}else{
			if($status=='All'){
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.")"); 
			}
			if($status=='Online'){
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			}
			if($status=='Offline'){
				$sql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live!='Y'");
			} 
				 
		}
	}
	
}
//echo $sql_qry;die;

 $sql = mysqli_query($con,$sql_qry); 

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
									//$atm_id = $sql_result['ATMID'];
									$city = $sql_result['City'];
									$state = $sql_result['State'];
									$zone = $sql_result['Zone'];
									$eng_name = $sql_result['eng_name'];
									$call_id = $sql_result['cl_id'];
		                            $ticket_id = $sql_result['ticket_id'];
									
											$count++;
											$key_status = 0;
										if($count%10==0){
											$key_status = 1;
										}	
											
										$data_arr = [];
										$data_arr['atm_id'] = $atm_id;
										$data_arr['site_address'] = $site_address;
										
										$data_arr['city'] = $city;
										$data_arr['state'] = $state;
										$data_arr['zone'] = $zone;
										$data_arr['eng_name'] = $eng_name;
										$data_arr['call_id'] = $call_id;
										$data_arr['ticket_id'] = $ticket_id;
										$data_arr['key_status'] = $key_status;
										
										array_push($_data,$data_arr);  	
										
									
							   
						  }
					   }
					 }
			  $array = array(['count'=>$count,'res_data'=>$_data]);
					CloseCon($con);
					echo json_encode(utf8ize($array));
			?>
                      

