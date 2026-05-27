<?php session_start();include('db_connection.php'); 
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

   $bank = "";
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
$con = OpenCon();

if($atmid!=''){
$sql = mysqli_query($con,"select status,atmid,last_communication,ip,cdate from dvr_health where atmid='".$atmid."' and login_status='1'"); 
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
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
		}else{
			 $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		} 
	  
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	if(mysqli_num_rows($sitesql)){
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	}else{
		$atmidarray=[];
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$offlinetestsql = "SELECT status,atmid,last_communication,ip,cdate FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='1'";
    $sql = mysqli_query($con,$offlinetestsql);
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


<div class="table-responsive">
                    <table id="order-listing2" class="table">
                      <thead>
                        <tr>
							<th>Sno.</th>
							<th>Site Name</th>
							<th>ATMID</th>
							<th>DVR IP</th>
							<th>DVR Status</th>
							<th>Last DVR Communication</th>
							<th>Duration</th>
							<th>Panel Status</th>
							<th>Last Panel Communication</th>
							<th>HDD Status</th>
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $dvrstatus=1;
						   if(mysqli_num_rows($sql)>0){
							  $count = 0 ; 
							  while($sql_result = mysqli_fetch_assoc($sql)){
								  $site_atmid = $sql_result['ATMID'];
                                    
							        $hddstatus = 'InActive';
									$hddclass = 'badge badge-pill badge-danger';
									$dvrhdd_status_query = mysqli_query($con,"SELECT status,atmid,last_communication,ip,cdate FROM dvr_health WHERE atmid = '".$site_atmid."'");
									if(mysqli_num_rows($dvrhdd_status_query)>0){
										$dvrhdd_sql_result = mysqli_fetch_assoc($dvrhdd_status_query);
										if($dvrhdd_sql_result['status']==1){
											$hddstatus = 'Active';
											$hddclass = 'badge badge-pill badge-success';
										}
									}
								 								 
								$_view = 0;
								$siteaddress = $sql_result['SiteAddress'];
								
								$dvrip = $sql_result['DVRIP'];
								$panelip = $sql_result['PanelIP'];
								$routerip = $sql_result['RouterIp'];
								
								$panelsql = mysqli_query($con,"select status,date from panel_health where atmid='".$site_atmid."'"); 
								 $panel_status = '-';$panel_comm_date = '-';
								 if(mysqli_num_rows($panelsql)>0){
								 $panel_sql_result = mysqli_fetch_assoc($panelsql);
								 $panel_status = $panel_sql_result['status'];
								 $panel_comm_date = $panel_sql_result['date'];
								 }
								 $panelstatus = '-';$panelclass='';
								 if($panel_status==0){
									 $panelstatus = 'Online';
									 $panelclass = 'badge badge-pill badge-success';
								 }
								 if($panel_status==1){
									 $panelstatus = 'Offline';
									 $panelclass = 'badge badge-pill badge-danger';
								 }
								
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
								}
								
								if($_view==1){
									$count = $count + 1;
									 if($dvrlast_communication=='0000-00-00 00:00:00'){
										 $dvrlast_communication = $start_date_time." 14:16:00";
									 }
								     $datetime1 = '0000-00-00 00:00:00';
								     $offlinetestsql = "SELECT status,atmid,last_communication,ip,cdate FROM dvr_health WHERE atmid='".$site_atmid."'";
                                     $offline_sql_query = mysqli_query($con,$offlinetestsql); 
	                                 if(mysqli_num_rows($offline_sql_query)>0){   
                                           $offline_sql_result = mysqli_fetch_assoc($offline_sql_query);									 
								              $datetime1 = $offline_sql_result['cdate'];
									 }
									 $datetime2 = $dvrlast_communication;
									 $duration = "";
									 if(!is_null($datetime1) && !is_null($datetime2)){
									    $datetime1 = new DateTime($datetime1);
										$datetime2 = new DateTime($datetime2);
										$interval = $datetime1->diff($datetime2);
										
										$elapsedyear = $interval->format('%y');
										$elapsedmon = $interval->format('%m');
										$elapsed_day = $interval->format('%a');
										$elapsedhr = $interval->format('%h');
										$elapsedmin = $interval->format('%i');
										if($elapsedyear>0){
											$duration = $elapsedyear." year ";
										}
										if($elapsedmon>0){
											$duration = $duration.$elapsedmon." months ";
										}
										if($elapsed_day>0){
											$duration = $duration.$elapsed_day." days ";
										}
										if($elapsedhr>0){
											$duration = $duration.$elapsedhr." hours ";
										}
										if($elapsedmin>0){
											$duration = $duration.$elapsedmin." minutes ";
										}
										
									 }
							  ?>
							   <tr>
							    <td><?php echo $count;?></td>
                                <td><?php echo $siteaddress;?></td>  <td><?php echo $site_atmid;?></td>
								<td><?php echo $sql_result['DVRIP'];?></td>
                                <td class="pr-0 text-right"><div class="badge badge-pill badge-danger"><?php echo 'Offline';?></div></td>
								<td><?php echo $dvrlast_communication;?></td>
								<td><?php echo $duration;?></td>
								<td><div class="<?php echo $panelclass;?>"><?php echo $panelstatus;?></div></td>
								<td><?php echo $panel_comm_date;?></td>
								<td><div class="<?php echo $hddclass;?>"><?php echo $hddstatus;?></div></td>
								</tr>
								
						<?php }
						   } }
						?>
                      </tbody>
                    </table>
                  </div>

<?php
CloseCon($con);

?>

