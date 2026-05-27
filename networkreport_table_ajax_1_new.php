<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d');

?>
<?php 
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

//$bank = "PNB";
$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	//$sql = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where atmid='".$atmid."' and live='Y'";
	$sql_qry = "select s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
                 from sites s where s.ATMID='".$atmid."' and s.live='Y'";
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
			$sql_qry = "select s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
			 from sites s where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
		}else{
			 $sql_qry = "select s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
			 from sites s where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'";
		} 
	  
	}else{
		if($client=='All'){
			$sql_qry = "select s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
                 from sites s where s.live='Y'";
		  // $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where live='Y'";	
		}else{
			$sql_qry = "select s.Bank,s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2
                 from sites s where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'";
		 //  $sql_qry = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp,ATMID_2 from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
	    }
	}
	
}
//echo $sql_qry;die;

 $sql = mysqli_query($con,$sql_qry); 
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>S.N</th>
							<th>ATM-ID</th><th>ATM-ID 2</th>
							<th>Site Address</th>
							<th>Router</th>
							<!--<th>Router IP</th>-->
							<th>Router Last Communication</th>
							<th>Till Router Online %</th>
							<th>DVR</th>
							<!--<th>DVR IP</th>-->
							<th>DVR Last Communication</th>
							<th>Till DVR Online %</th>
							<th>Panel</th>
							<!--<th>Panel IP</th>-->
							<th>Panel Last Communication</th>
							<th>Till Panel Online %</th>                         
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						
                        $count = 0; 
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
									$atm_id = $sql_result['ATMID'];$atm_id_2 = $sql_result['ATMID_2'];
									$dvrip = $sql_result['DVRIP'];
									$panelip = $sql_result['PanelIP'];
									$routerip = $sql_result['RouterIp'];
									$sn = $sql_result['SN'];
									
									$check_network_report_list = mysqli_query($con,"select * from network_report_list where SN='".$sn."'"); 
									if(mysqli_num_rows($check_network_report_list)>0){
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
										
										$net_rep_list = mysqli_fetch_assoc($check_network_report_list);
										$tb_id = $net_rep_list['id'];
										$tb_last_action_date = $net_rep_list['last_action_date'];
										$router_status_total = $net_rep_list['router_tot_count'];
										$router_status_online = $net_rep_list['router_online_count'];
										$dvr_status_total = $net_rep_list['dvr_tot_count'];
										$dvr_status_online = $net_rep_list['dvr_online_count'];
										$panel_status_total = $net_rep_list['panel_tot_count'];
										$panel_status_online = $net_rep_list['panel_online_count'];
										
									    $routerlast_communication = $net_rep_list['router_lastcommunication'];
										$dvrlast_communication = $net_rep_list['dvr_lastcommunication'];
										$panellast_communication = $net_rep_list['panel_lastcommunication'];
										
										 $router_status = $net_rep_list['router_status'];
										$dvr_status = $net_rep_list['dvr_status'];
										$panel_status = $net_rep_list['panel_status'];
									
									
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
									
					  ?>
							   <tr>
							   <td><?php echo $count;?></td>
							    <td><?php echo $atm_id;?></td><td><?php echo $atm_id_2;?></td>
								<td><?php echo $site_address;?></td>
                  <td><?php if($router_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
				  <!--<td><?php //echo $routerip;?></td>-->
				  <td><?php echo $routerlast_communication;?></td>
				  <td><?php echo $routeronlinepercent;?></td>
                  <td><?php if($dvr_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
                  <!--<td><?php //echo $dvrip;;?></td>-->
				  <td><?php echo $dvrlast_communication;?></td>
				  <td><?php echo $dvronlinepercent;?></td>
                  <td><?php if($panel_status==1){ echo 'Online';}else{ echo 'Offline';}?></td>
                  <!--<td><?php //echo $panelip;;?></td>-->
				  <td><?php echo $panellast_communication;?></td>
				  <td><?php echo $panelonlinepercent;?></td>
                  
								</tr>
								
						<?php   }
							  }
						   }
						 }
						  CloseCon($con);
						?>
                      </tbody>
                    </table>
                  </div>

