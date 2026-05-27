<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

//$month = $_GET['month'];
//$year = $_GET['year'];

//$start_date = $_GET['start_date'];
//$end_date = $_GET['end_date'];

$start_date = "2023-04-20";
$end_date = "2023-04-27";

$today = date('Y-m-d');
$today_split = explode("-",$today);
$this_year = $today_split[0];
$this_month = $today_split[1];
$created_at = date('Y-m-d H:i:s');
//echo $created_at;die;
$split_created_at = explode(' ',$created_at);
$split_time = explode(":", $split_created_at[1]);
$nowtime_hour = $split_time[0];

$current_mon = date('m');
/*
if($current_mon==$month){

$_date = date('d');
$_date = (int)$_date;
$_yes_date = $_date - 1;


$total_timemonth = $_yes_date * 24;
$total_timemonth = $total_timemonth + $nowtime_hour;

}else{
	if($month==3){
		$total_timemonth = 31 * 24;
	}
	if($month==2){
		$total_timemonth = 28 * 24;
	}
	if($month==1){
		$total_timemonth = 31 * 24;
	}
}
*/
$site_monitoring_charges = "3550";


?>
<?php 

$client = "Hitachi";
//$client = $_GET['client'];
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

$bank = "PNB";

$list=array();$list1=array();

$month = date('m');
$year = date('Y');

$uptime_arr = array();
	$downtime_arr = array();
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		if($d==1){
			$_first_date_month = date('Y-m-d', $time);
		}
		$list1[]=date('Y-m-d', $time);
		$uptime_arr[] = 0;
		$downtime_arr[] = 0;
	}
}


/*
$sn = 2850;
    $net_qry_sql = "SELECT uptime,downtime,month_date FROM `newnetwork_report` WHERE SN='".$sn."' AND month='".$month."' AND year='".$year."' ";
	$net_sql_res = mysqli_query($con,$net_qry_sql);
	$total_time = 0;
	$total_net_his = mysqli_num_rows($net_sql_res);
	$net_his_not = 0;
	$atlastmonthdate = ''; */
	//$net_his_sql_result1 = mysqli_fetch_assoc($net_sql_res);
	//echo '<pre>';print_r($net_his_sql_result1);echo '</pre>';die;
	
	
	/*
	if($total_net_his>0){
		while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
			$_mon_dt = $net_his_sql_result['month_date'];
			echo "Uptime : ".$net_his_sql_result['uptime'];
			
			for($i=0;$i<count($list1);$i++){ 
				$mon_date = $list1[$i];	
				if($_mon_dt==$mon_date){
					$total_time = $net_his_sql_result['uptime'];
					$net_his_not = $net_his_sql_result['downtime'];
				}
				
			}
			$uptime_arr[] = $total_time;
			$downtime_arr[] = $net_his_not; 
		}
	}
*/
    

//$bank = "PNB"; $circle= "Pathankot";
//$net_qry = "SELECT GROUP_CONCAT(concat(c.device,'_',c.cnt)) AS device_count,c.site_id FROM (SELECT device,COUNT(device) AS cnt,site_id FROM `network_history` WHERE status='OK' AND rectime >= SUBDATE( NOW(), INTERVAL 3 HOUR) GROUP BY device,site_id) c GROUP BY c.site_id";
//$net_qry = "select COUNT(*) AS status_count,device,status from network_history where site_id ='".$sn."' AND status='OK' AND CAST(rectime AS DATE)='".$today."' GROUP by device";
if($atmid!=''){
	$sql = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.ATMID='".$atmid."' and live='Y' GROUP BY s.SN";
	/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.ATMID='".$atmid."' and s.live='Y'"; */
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
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' GROUP BY s.SN";	
			   /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			    */
			}else{
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";	
		        /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'"; */
			} 
	  
	}else{
		if($client=='All'){
			/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.live='Y' GROUP BY s.SN";	
		}else{
		/*	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' GROUP BY s.SN";
	    }
	}
	
}

 
 $sql = mysqli_query($con,$sql_qry); 
?>
<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>SI</th><th>ATMID</th>
							<th>Circle</th><th>ZO</th>
							<th>State</th>
							<th>Location</th>
							<th>Site Type</th>
							<th>Total Sites Down in Hrs & Min</th>
							<th>Total Downtime in %</th>
							<th>Availability (%)</th>					
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						      $today = date('Y-m-d');
							// $start_date = $_first_date_month;
							  
                              $last_date =  date("Y-m-t", strtotime($_first_date_month));
							 // $end_date = $last_date;
                        $count = 0; 
						 if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){
								$atm_id = $sql_result['ATMID'];
								$live_dt = $sql_result['live_date'];
								
								$live_dt_arr = explode("-",$live_dt);
								$live_dt_year = "";$live_dt_month = "";
								if(count($live_dt_arr)==3){
								  $live_dt_year = $live_dt_arr[0];
								  $live_dt_month = $live_dt_arr[1];
								}
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($atm_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								/*
								if($live_dt > $last_date){
									$_view = 0;
								}
								if($live_dt_year==$this_year){
									if($live_dt_month==$this_month){
										$_view = 0;
									}
								} */
								if($_view == 1){
									$site_address = $sql_result['SiteAddress'];
									
									$_Zone = $sql_result['Zone'];
									$_circleName = $sql_result['Circle'];
									$sn = $sql_result['SN'];
									$site_live_date = $sql_result['live_date'];
									$_State = $sql_result['State'];
									
									$count++;
									
									$total_uptime = 0;$total_downtime = 0;
									$tot_cnt = 0;$tot_daycnt = 0; $is_lies = 0;
									
									$net_qry_sql = "SELECT uptime,downtime,month_date FROM `newnetwork_report` WHERE SN='".$sn."' AND month_date>='".$start_date."' AND month_date<='".$end_date."' ";
									//echo $net_qry_sql."_";
									$net_sql_res = mysqli_query($con,$net_qry_sql);
									$total_time = 0;
									$total_net_his = mysqli_num_rows($net_sql_res);
									$net_his_not = 0;
									$atlastmonthdate = '';
									if($total_net_his>0){
										while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
											$total_uptime = $total_uptime + $net_his_sql_result['uptime'];
											$tot_daycnt = $tot_daycnt + 1;
										}
									}
									
									if($end_date==$today){
										$total_timemonth = ($tot_daycnt - 1) * 24;
									}else{
									    $total_timemonth = ($tot_daycnt) * 24; 
									}
									$total_timemonth = $total_timemonth + $nowtime_hour; 
									$tot_dwntime = $total_timemonth - $total_uptime;
									$total_downtime = $total_timemonth - $total_uptime; 
									$penalty_amt = 0; $bet_penalty_amt = 0;
									 
										$penaltysql = mysqli_query($con,"select penalty_percentage from esurv_network_penalty_master where minimum_hour<'".$total_downtime."' AND maximum_hour>='".$total_downtime."'");
										if(mysqli_num_rows($penaltysql)>0){
											$penaltysql_result = mysqli_fetch_assoc($penaltysql);
											$percentage = $penaltysql_result['penalty_percentage'];
											$penalty_amt = ($site_monitoring_charges * $percentage)/100;
										}else{
											if($total_downtime > 48){
												$percentage = 100;
												$penalty_amt = ($site_monitoring_charges * $percentage)/100;
											}
										}
										
										/*
										 $uptime_percent = 0;
										 if($total_timemonth>0){
										 $uptimepercent = ($total_uptime * 100)/$total_timemonth;
										 $penalty_percent_int = (int) $uptimepercent;
										 $uptime_percent = number_format((float)$uptimepercent, 2, '.', '');
											 if($penalty_percent_int>=90){
												$penalty_amt = 0; 
											 }
										 }
										 */
										 
										 $downtime_percent = 0;
										 
										 if($total_timemonth>0){
										 $downtimepercent = ($total_downtime * 100)/$total_timemonth;
										 $downtime_percent = number_format((float)$downtimepercent, 2, '.', '');
										 
										 }
										 
										 $available_percent = 100 - $downtime_percent;
										// $downtime_percent_int = (int) $downtimepercent;
										 
										if($total_downtime>200){
											$tot_dwntime = $total_downtime;
											//$penalty_amt = $site_monitoring_charges;
										}else{
											$tot_dwntime = 0;
										}	

                                        if($total_downtime>36 && $total_downtime<200){
											if($total_downtime<150){
												//$total_downtime = 0;
											}else{
											    $_bet_tot_dwntime = $total_downtime;
											    $bet_penalty_amt = ($site_monitoring_charges * 75)/100;
											}
										}else{
											$_bet_tot_dwntime = "-";
										}	
									
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $atm_id;?></td>
										   <td><?php echo $_circleName;?></td>
										   <td><?php echo $_Zone;?></td>
										   <td><?php echo $sql_result['State'];?></td>
										   <td><?php echo $site_address;?></td>
						                   <td><?php echo '-';?></td><td><?php echo $total_downtime;?></td>
										   <td><?php echo $downtime_percent;?></td><td><?php echo $available_percent;?>
										   
										</tr>
								
								<?php   //}
									  }
								   }
								 }
								  CloseCon($con);
								?>
                      </tbody>
                    </table>
                  </div>

