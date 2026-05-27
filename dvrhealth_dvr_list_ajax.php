<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); 
$con = OpenCon();
$start_date_time = date('Y-m-d', strtotime('-7 days'));
$time = date("H:i:s");
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
       $client = $_GET['client'];
	   
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
		}
		
$bank = $_GET['bank'];
$atmid = $_GET['atmid'];
$dvrstatus = $_GET['status'];
$circle = "";
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
if($dvrstatus==0){
	//$_status = 1;
}


if($atmid!=''){   // and login_status='".$dvrstatus."'
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where atmid='".$atmid."' and live='Y'");
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
				$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		}else{ 
			$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");	
		} 
	    
	}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
?>

        <table class="table table-striped" id="order-listing" >
		  <thead>
			<tr>
			  <th style="width:65%;">Site Name</th>
			  <th>ATMID</th>
			  <th>Last Communication</th>
			  <th>Last Scanned</th>
			</tr>
		  </thead>
		  <tbody>
<?php
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$_view = 0;
		$site_address = $sql_result['SiteAddress'];
		$atm_id = $sql_result['ATMID'];
		$_is_atmid_exist = 0;
		if($_SESSION['access']==1){
			$_is_atmid_exist = 1;
		}else{
			if (in_array($atm_id, $_circle_name_array)){
				$_is_atmid_exist = 1;
			}
		}
		if($_is_atmid_exist == 1){
			$dvrip = $sql_result['DVRIP'];
			$panelip = $sql_result['PanelIP'];
			$routerip = $sql_result['RouterIp'];
			$sn = $sql_result['SN'];
			$aisql = mysqli_query($con,"select router,dvr,panel from network_report where SN ='".$sn."'"); 
			if(mysqli_num_rows($aisql)>0){
				$aisql_result = mysqli_fetch_assoc($aisql);
				$routerlast_communication = $aisql_result['router'];
				$dvrlast_communication = $aisql_result['dvr'];
				$panellast_communication = $aisql_result['panel'];
				$datetime1 = new DateTime();
				$dvr_status = 0;
				$router_status = 0;
				$panel_status = 0;
				if(!is_null($routerlast_communication)){
					$router_status = lastcommunicationdiff($routerlast_communication);
					if($router_status>0){
						if(!is_null($dvrlast_communication)){
							
							$dvr_status = lastcommunicationdiff($dvrlast_communication);
							if($dvr_status>0){
								if($dvrstatus==0)
									$_view = 1;
							}else{
								if($dvrstatus==1)
									$_view = 1;	
							}
						}else{
							if($dvrstatus==1)
									$_view = 1;	
						}
					}else{
						if($dvrstatus==1)
									$_view = 1;	
					}
				}else{
					if($dvrstatus==1)
								$_view = 1;	
				}
				
					
				
			}
			
		}
		if($_view==1){
		     if($dvrlast_communication=='0000-00-00 00:00:00'){
				 $dvrlast_communication = $start_date_time." 14:16:00";
			 }
		?>
	            <tr>
				  <td><?php echo $site_address;?></td><td><?php echo $atm_id;?></td>
				  <td class="pr-0 text-right"><div class="badge badge-pill badge-success"><?php echo $dvrlast_communication;?></div></td>
				  <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo $dvrlast_communication;?></div></td>
				  
				  
				</tr>
		<?php	}
						}
					}
				  
				  ?>
				
			  </tbody>
			</table>
<?php
CloseCon($con);

?>


