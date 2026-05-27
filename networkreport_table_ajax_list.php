<?php session_start();include('db_connection.php'); 
date_default_timezone_set('Asia/Kolkata');
function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
   // global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        if($_change == 1){
				if($panel_name=='comfort'){
		            if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
						$return = $sql_result[$paramater]." Restoral";
					}
				}
				else{	
				   if(substr($alarm, -1)=='R'){
					$return = $sql_result[$paramater]." Restoral";
				   }
				}
				
		    } else{
		        $return = $sql_result[$paramater];
			}
		}else{
			$return = "";
		}
		
	}
	return $return;
  //  CloseCon($con);
	
 //  return $panel_name;
}
?>
<?php 
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
			if($hour<=2){
				$return = 1;
			}else{
				$return = 0;
			}
		}
				
		return $return;	   
  }
function getsitedetail($paramater,$panelid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
 

function getPanelIDByAtmid($atmid,$con){
	//global $con;
    $sql = mysqli_query($con,"select * from sites where ATMID like '%".$atmid."%' "); 
    $sql_resultneo = mysqli_fetch_assoc($sql);
	return $sql_resultneo['NewPanelID'];
}

$con = OpenCon();

$device = $_GET['device'];
$status = $_GET['status'];


$client = $_GET['client'];
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

 $bank = "";$circle="";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
//echo $circle;die;

if($atmid!=''){
	if($device=='R'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND router_status='".$status."' GROUP BY SN");
	}
	if($device=='D'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND dvr_status='".$status."' GROUP BY SN");
	}
	if($device=='P'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND panel_status='".$status."' GROUP BY SN");
	}
}else{
	if($bank!=''){
		if($circle!=''){
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
			$circleatmidarray = [];
			while($circlesql_result = mysqli_fetch_assoc($circlesql)){
				$circleatmidarray[] = $circlesql_result['ATMID'];
				
			}
			//echo count($circleatmidarray);
			$circleatmidarray=json_encode($circleatmidarray);
			$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
			$circlearr=explode(',',$circleatmidarray);
			$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND router_status='".$status."' GROUP BY SN");
			}
			if($device=='D'){
				//$_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";
				$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."' GROUP BY SN");
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND panel_status='".$status."' GROUP BY SN");
			}
				

		}else{
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and live='Y' AND router_status='".$status."' GROUP BY SN");
			}
			if($device=='D'){
				//$_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and live='Y' AND dvr_status='".$status."' GROUP BY SN");
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' and Bank='".$bank."' and live='Y' AND panel_status='".$status."' GROUP BY SN");
			}
			//$circlesql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		}
				
	  
	}else{
		if($client=='All'){
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where live='Y' AND router_status='".$status."'");
			}
			if($device=='D'){
				//$_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";
				$sql = mysqli_query($con,"select * from network_report_list where live='Y' AND dvr_status='".$status."' GROUP BY SN");
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where live='Y' AND panel_status='".$status."' GROUP BY SN");
			}
		   //$circlesql = mysqli_query($con,"select ATMID from sites where live='Y'");	
		}else{
			
			if($device=='R'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' AND Bank IN (".$_bank_name.") AND live='Y' AND router_status='".$status."' GROUP BY SN");
			}
			if($device=='D'){
				//$_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' AND Bank IN (".$_bank_name.") AND live='Y' AND dvr_status='".$status."' GROUP BY SN");
			}
			if($device=='P'){
				$sql = mysqli_query($con,"select * from network_report_list where Customer='".$client."' AND Bank IN (".$_bank_name.") AND live='Y' AND panel_status='".$status."' GROUP BY SN");
			}
			
		   //$circlesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	    }
	}
	
	/*
	if($device=='R'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND router_status='".$status."'");
	}
	if($device=='D'){
	    $_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";echo $_se;die;
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'");
	}
	if($device=='P'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND panel_status='".$status."'");
	}
		
    */
	
}
  
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>ATM-ID</th>
							<th>Site Address</th>
							<th>Router</th>
							<th>Router IP</th>
							<th>Router Last Communication</th>
							<th>Till Router Online %</th>
							<th>DVR</th>
							<th>DVR IP</th>
							<th>DVR Last Communication</th>
							<th>Till DVR Online %</th>
							<th>Panel</th>
							<th>Panel IP</th>
							<th>Panel Last Communication</th>
							<th>Till Panel Online %</th>                         
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 0; 
						if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){ $count++;
								$site_address = $sql_result['SiteAddress'];
								$atm_id = $sql_result['ATMID'];
								$router_status = $sql_result['router_status'];
								$routerip = $sql_result['router_ip'];
								$routerlast_communication = $sql_result['router_lastcommunication'];
								$routeronlinepercent = $sql_result['router_online_percent'];
								$dvr_status = $sql_result['dvr_status'];
								$dvrip = $sql_result['dvr_ip'];
								$dvrlast_communication = $sql_result['dvr_lastcommunication'];
								$dvronlinepercent = $sql_result['dvr_online_percent'];
								$panel_status = $sql_result['panel_status'];
								$panelip = $sql_result['panel_ip'];
								$panellast_communication = $sql_result['panel_lastcommunication'];
								$panelonlinepercent = $sql_result['panel_online_percent'];
                       ?>
							   <tr>
							   <td><?php echo $count;?></td>
							   <td><?php echo $atm_id;?></td>
							   <td><?php echo $site_address;?></td>
							   <td><?php if($router_status==0){ echo 'Offline';}else{ echo 'Online';}?></td>
							   <td><?php echo $routerip;?></td>
							   <td><?php echo $routerlast_communication;?></td>
							   <td><?php echo $routeronlinepercent;?></td>
							   <td><?php if($dvr_status==0){ echo 'Offline';}else{ echo 'Online';}?></td>
							   <td><?php echo $dvrip;?></td>
							   <td><?php echo $dvrlast_communication;?></td>
							   <td><?php echo $dvronlinepercent;?></td>
							   <td><?php if($panel_status==0){ echo 'Offline';}else{ echo 'Online';}?></td>
							   <td><?php echo $panelip;;?></td>
							   <td><?php echo $panellast_communication;?></td>
							   <td><?php echo $panelonlinepercent;?></td>
                  
								</tr>
								
								<?php }
        						}
							
						  CloseCon($con);
						?>
                      </tbody>
                    </table>
                  </div>

