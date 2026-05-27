<?php session_start();include('db_connection.php'); 
date_default_timezone_set('Asia/Kolkata');
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
/*
if($atmid!=''){
	if($device=='R'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND router_status='".$status."'");
	}
	if($device=='D'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND dvr_status='".$status."'");
	}
	if($device=='P'){
	$sql = mysqli_query($con,"select * from network_report_list where ATMID='".$atmid."' AND panel_status='".$status."'");
	}
}else{
	if($bank!=''){
		if($circle!=''){
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
		}else{
			$circlesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		}
				
	  
	}else{
		if($client=='All'){
		$circlesql = mysqli_query($con,"select ATMID from sites where live='Y'");	
		}else{
		$circlesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	    }
	}
	
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
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND router_status='".$status."'");
	}
	if($device=='D'){
		//$_se = "select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'";echo $_se;die;
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND dvr_status='".$status."'");
	}
	if($device=='P'){
		$sql = mysqli_query($con,"select * from network_report_list where ATMID IN (".$circleatmidarray.") AND panel_status='".$status."'");
	}
	
}
*/  


if($atmid!=''){
	$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where atmid='".$atmid."' and live='Y'");
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
				$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		         $sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
	  
	}else{
		if($client=='All'){
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where live='Y'");	
		}else{
		$sql = mysqli_query($con,"select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	    }
	}
	
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
							   <td><?php if($router_status==0){ echo 'Online';}else{ echo 'Offline';}?></td>
							   <td><?php echo $routerip;?></td>
							   <td><?php echo $routerlast_communication;?></td>
							   <td><?php echo $routeronlinepercent;?></td>
							   <td><?php if($dvr_status==0){ echo 'Online';}else{ echo 'Offline';}?></td>
							   <td><?php echo $dvrip;?></td>
							   <td><?php echo $dvrlast_communication;?></td>
							   <td><?php echo $dvronlinepercent;?></td>
							   <td><?php if($panel_status==0){ echo 'Online';}else{ echo 'Offline';}?></td>
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

