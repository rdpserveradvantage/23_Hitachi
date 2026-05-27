<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

//$month = $_GET['month'];
//$year = $_GET['year'];


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

function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

//$start_date = $_GET['start_date'];
//$end_date = $_GET['end_date'];
$start_date = "2023-04-25";
$end_date = "2023-04-28";
$_dt_range = createDateRangeArray($start_date,$end_date);
//echo '<pre>';print_r($_dt_range);echo '</pre>';die;
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
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.ATMID='".$atmid."' and live='Y' GROUP BY s.SN";
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
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' GROUP BY s.SN";	
			   /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			    */
			}else{
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";	
		        /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'"; */
			} 
	  
	}else{
		if($client=='All'){
			/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.live='Y' GROUP BY s.SN";	
		}else{
		/*	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' GROUP BY s.SN";
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
							<th>Total Downtime in Hrs & Min</th>
							<th>Downtime > 200 Hrs</th>
							<th>Penalty Amt in Case System not up within TAT</th>
							<th>Penalty for Downtime < 95% >36 Hrs to < 200 Hrs</th>
							<th>Penalty for Camera not operational</th> 				
                        </tr>
                      </thead>
                      <tbody>
					    <?php $yesterday = date('Y-m-d',strtotime("-1 days"));
						      $today = date('Y-m-d');
							//  $start_date = $_first_date_month;
							  
                              $last_date =  date("Y-m-t", strtotime($_first_date_month));
							//  $end_date = $last_date;
							$tot_daycnt = count($_dt_range);
							if($end_date==$today){
								$total_timemonth = ($tot_daycnt - 1) * 24;
								$total_timemonth = $total_timemonth + $nowtime_hour;
							}else{
								$total_timemonth = ($tot_daycnt) * 24; 
							}
                        $count = 0; 
						 if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){
								$atm_id = $sql_result['ATMID'];
								$live_dt = $sql_result['live_date'];
								$site_type = $sql_result['site_type'];
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
									$sn = "4769";
									$net_qry_sql = "SELECT uptime,downtime,month_date FROM `newnetwork_report` WHERE SN='".$sn."' AND month_date>='".$start_date."' AND month_date<='".$end_date."' ";
									$net_sql_res = mysqli_query($con,$net_qry_sql);
									$total_time = 0;
									$total_net_his = mysqli_num_rows($net_sql_res);
									$net_his_not = 0;
									$atlastmonthdate = '';
									if($total_net_his>0){
										while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
											$total_uptime = $total_uptime + $net_his_sql_result['uptime'];
											//$tot_daycnt = $tot_daycnt + 1;
										}
									}
									echo $total_timemonth. " - ". $total_uptime;die;									
									$tot_dwntime = $total_timemonth - $total_uptime;
									$total_downtime = $total_timemonth - $total_uptime;
									$penalty_amt = 0; $bet_penalty_amt = 0;
									$_is_penalty_deduct = 0;
									if($site_type=='SEMI URBAN'){
										if($total_downtime>48){
											$_is_penalty_deduct = 1;
										}
									}
									if($site_type=='METRO'){
										if($total_downtime>12){
											$_is_penalty_deduct = 1;
										}
									}
									if($site_type=='URBAN'){
										if($total_downtime>24){
											$_is_penalty_deduct = 1;
										}
									}
									if($site_type=='RURAL'){
										if($total_downtime>72){
											$_is_penalty_deduct = 1;
										}
									}
									
									if($_is_penalty_deduct==1){ 
										$penaltysql = mysqli_query($con,"select penalty_percentage from esurv_network_penalty_master_new where minimum_hour<'".$total_downtime."' AND maximum_hour>='".$total_downtime."'");
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
										
										
										$camtotal_uptime = 0;$camtotal_downtime = 0;
									$camtot_cnt = 0;$camtot_daycnt = 0; $camis_lies = 0;
									/*
									$cam_qry_sql = "SELECT uptime,downtime,month_date FROM `newdvr_report` WHERE SN='".$sn."' AND month_date>='".$start_date."' AND month_date<='".$end_date."' ";
									$cam_sql_res = mysqli_query($con,$cam_qry_sql);
									$camtotal_time = 0;
									$total_cam_his = mysqli_num_rows($cam_sql_res);
									$cam_his_not = 0;
									$atlastmonthdate = '';
									if($total_cam_his>0){
										while($cam_his_sql_result = mysqli_fetch_assoc($cam_sql_res)){
											$camtotal_uptime = $camtotal_uptime + $cam_his_sql_result['uptime'];
											$tot_daycnt = $tot_daycnt + 1;
										}
									}
									
								
									$camtot_dwntime = $total_timemonth - $camtotal_uptime;
									$camtotal_downtime = $total_timemonth - $camtotal_uptime;
									$campenalty_amt = 0;
									
									 
										$campenaltysql = mysqli_query($con,"select penalty_percentage from esurv_camera_penalty_master where minimum_hour<'".$camtotal_downtime."' AND maximum_hour>='".$camtotal_downtime."'");
										if(mysqli_num_rows($campenaltysql)>0){
											$campenaltysql_result = mysqli_fetch_assoc($campenaltysql);
											$campenalty_amt = $campenaltysql_result['penalty_percentage'];
											
										}else{
											if($camtotal_downtime > 24){
												$campenalty_amt = 700;
												
											}
										}
										
                                       */    										
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $atm_id;?></td>
										   <td><?php echo $_circleName;?></td>
										   <td><?php echo $_Zone;?></td>
										   <td><?php echo $sql_result['State'];?></td>
										   <td><?php echo $site_address;?></td><td><?php echo $site_type;?></td>
						                   <td><?php echo $total_downtime;?></td><td><?php echo $tot_dwntime;?></td>
										   <td><?php echo '0';?></td><td><?php echo $penalty_amt;?></td>
										   <td><?php echo '0';?></td>
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

