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

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

//$start_date = "2023-04-26";
//$end_date = "2023-04-26";

$_dt_range = createDateRangeArray($start_date,$end_date);

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

//$client = "Hitachi";
$client = $_POST['client'];
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
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}

//$bank = "PNB";

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

if($atmid!=''){
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.ATMID='".$atmid."' and live='Y' GROUP BY s.SN";
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
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' GROUP BY s.SN";	
		   /* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
			 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y'";
			*/
		}else{
			$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";	
			/* $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
			 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y'"; */
		} 
	  
	}else{
		if($client=='All'){
			/*$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.live='Y' GROUP BY s.SN";	
		}else{
		/*	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,n.device_count
                 from sites s left join (".$net_qry.") n ON s.SN=n.site_id where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y'"; */
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,sc.Circle,sc.site_type from sites s left join site_circle sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' GROUP BY s.SN";
	    }
	}
	
}

 
 $sql = mysqli_query($con,$sql_qry); 
 $newcolumn_array = array();
 $column_array = array();
 $column_array = ["S.N","ATM-ID","Circle","ZO","State","Location","Site Type","Camera"];
 $column_name_array = ["First","Second","Third","Fourth","Fifth","Sixth","Seventh"];
 $j = count($column_name_array);
 
 for($i=0;$i<count($column_array);$i++){
	 $_new_arr = array();
	 if($i<$j){
	   $_new_arr['name'] = $column_name_array[$i];
	 }
	 $_new_arr['title'] = $column_array[$i];
	 array_push($newcolumn_array,$_new_arr);
 }
 for($i=0;$i<count($_dt_range);$i++){
	 $dt_range = $_dt_range[$i]." (Uptime in Hrs)"; 
	 $new_arr = array();
	 $new_arr['title'] = $dt_range;
	 array_push($newcolumn_array,$new_arr);
 }
 $col_array = ["Total Up in Hrs","Total Down in Hrs"];
 for($i=0;$i<count($col_array);$i++){
	 $_new_array = array();
	 $_new_array['title'] = $col_array[$i];
	 array_push($newcolumn_array,$_new_array);
 }
 
 
 //echo '<pre>';print_r($newcolumn_array);echo '</pre>';

					     $yesterday = date('Y-m-d',strtotime("-1 days"));
						  $today = date('Y-m-d');
						  
						  $last_date =  date("Y-m-t", strtotime($_first_date_month));
						  $_array_data = array();
                        $count = 0; $_letcnt = 0;
						$tot_daycnt = count($_dt_range);
						if($end_date==$today){
							$total_timemonth = ($tot_daycnt - 1) * 24;
							$total_timemonth = $total_timemonth + $nowtime_hour;
						}else{
							$total_timemonth = ($tot_daycnt) * 24; 
						}
						 if(mysqli_num_rows($sql)){
							while($sql_result = mysqli_fetch_assoc($sql)){
								$atm_id = $sql_result['ATMID'];
								$live_dt = $sql_result['live_date'];
								$site_type = $sql_result['site_type'];
								
								$live_dt_year = "";$live_dt_month = "";
								if($live_dt!=''){
									$live_dt_arr = explode("-",$live_dt);
									if(count($live_dt_arr)==3){
									  $live_dt_year = $live_dt_arr[0];
									  $live_dt_month = $live_dt_arr[1];
									}
								}
								$_view = 0;
								if(count($_circle_name_array)==0){
									$_view = 1;
								}else{
									if(in_array($atm_id,$_circle_name_array)){
									   $_view = 1;
									}
								}
								if($live_dt > $last_date){
									$_view = 0;
								}
								if($live_dt_year==$this_year){
									if($live_dt_month==$this_month){
										$_view = 0;
									}
								}
								if($_view == 1){
									$site_address = $sql_result['SiteAddress'];
									$site_type = $sql_result['site_type'];
									$_Zone = $sql_result['Zone'];
									$_circleName = $sql_result['Circle'];
									$sn = $sql_result['SN'];
									$site_live_date = $sql_result['live_date'];
									$_State = $sql_result['State'];
									
									$count++;
									
									$tot_cnt = 0; $is_lies = 0;
                                    
									$_cam1_arr = array();$_cam2_arr = array();$_cam3_arr = array();$_cam4_arr = array();
                                   // echo $sn."_"; 
									//$_letcnt = $_letcnt + 1;
									//echo $_letcnt."_"; 
									$net_qry_sql = "SELECT * FROM `newdvr_report` WHERE SN='" . $sn . "' AND month_date>='" . $start_date . "' AND month_date<='" . $end_date . "' ";
									$net_sql_res = mysqli_query($con, $net_qry_sql);
									$total_time = 0;
									$total_net_his = mysqli_num_rows($net_sql_res);
									$net_his_not = 0;
									$atlastmonthdate = '';
									//echo $total_net_his;die;
									
									
									if ($total_net_his > 0) {
										while ($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)) {
											$_mnth_dt = $net_his_sql_result['month_date'];
											$_cam1_arr[$_mnth_dt] = $net_his_sql_result['cam1_uptime'];
											$_cam2_arr[$_mnth_dt] = $net_his_sql_result['cam2_uptime'];
                                            $_cam3_arr[$_mnth_dt] = $net_his_sql_result['cam3_uptime'];
                                            $_cam4_arr[$_mnth_dt] = $net_his_sql_result['cam4_uptime'];

											//$tot_daycnt = $tot_daycnt + 1;
										}
									}
									
									
										$_new_arr_data = array();
										$_new_arr_data[] = $count;
										$_new_arr_data[] = $atm_id;
										$_new_arr_data[] = $_circleName;
										$_new_arr_data[] = $_Zone;
										$_new_arr_data[] = $sql_result['State'];
										$_new_arr_data[] = $site_address;
										$_new_arr_data[] = $site_type;
										$_new_arr_data[] = "Lobby Camera";
										
										$_lobby_tot_uptime = 0;
										for($i=0;$i<count($_dt_range);$i++){ 
											$_lobby_cam_dt = $_dt_range[$i];
											if (array_key_exists($_lobby_cam_dt,$_cam1_arr)){
												$_lobby_tot_uptime = $_lobby_tot_uptime + $_cam1_arr[$_lobby_cam_dt];
												$_new_arr_data[] = $_cam1_arr[$_lobby_cam_dt];
										    }else{
											    $_new_arr_data[] = 0;	
											}
										}
										$total_cam1_downtime = $total_timemonth - $_lobby_tot_uptime;
										$_new_arr_data[] = $_lobby_tot_uptime;
										$_new_arr_data[] = $total_cam1_downtime;
										array_push($_array_data,$_new_arr_data);
										
										$_new_arr_data = array();
										$_new_arr_data[] = $count;
										$_new_arr_data[] = $atm_id;
										$_new_arr_data[] = $_circleName;
										$_new_arr_data[] = $_Zone;
										$_new_arr_data[] = $sql_result['State'];
										$_new_arr_data[] = $site_address;
										$_new_arr_data[] = $site_type;
										$_new_arr_data[] = "Outside ATM Room Camera";
										
										$_outside_tot_uptime = 0;
										 for($i=0;$i<count($_dt_range);$i++){ 
											$_outside_cam_dt = $_dt_range[$i];
											if (array_key_exists($_outside_cam_dt,$_cam2_arr)){
												$_outside_tot_uptime = $_outside_tot_uptime + $_cam2_arr[$_outside_cam_dt];
												$_new_arr_data[] = $_cam2_arr[$_outside_cam_dt];
											}else{
											    $_new_arr_data[] = 0;	
											}
										 }
										$total_cam2_downtime = $total_timemonth - $_outside_tot_uptime;
										$_new_arr_data[] = $_outside_tot_uptime;
										$_new_arr_data[] = $total_cam2_downtime;
										array_push($_array_data,$_new_arr_data);
										
										$_new_arr_data = array();
										$_new_arr_data[] = $count;
										$_new_arr_data[] = $atm_id;
										$_new_arr_data[] = $_circleName;
										$_new_arr_data[] = $_Zone;
										$_new_arr_data[] = $sql_result['State'];
										$_new_arr_data[] = $site_address;
										$_new_arr_data[] = $site_type;
										$_new_arr_data[] = "Backroom Camera";
										
										$_backroom_tot_uptime = 0;
										 for($i=0;$i<count($_dt_range);$i++){ 
											$_backroom_cam_dt = $_dt_range[$i];
											if (array_key_exists($_backroom_cam_dt,$_cam3_arr)){
												$_backroom_tot_uptime = $_backroom_tot_uptime + $_cam3_arr[$_backroom_cam_dt];
												$_new_arr_data[] = $_cam3_arr[$_backroom_cam_dt];
											}else{
											    $_new_arr_data[] = 0;	
											}
										}
										 $total_cam3_downtime = $total_timemonth - $_backroom_tot_uptime;
										 $_new_arr_data[] = $_backroom_tot_uptime;
										 $_new_arr_data[] = $total_cam3_downtime;
										 array_push($_array_data,$_new_arr_data);
										 
										$_new_arr_data = array();
										$_new_arr_data[] = $count;
										$_new_arr_data[] = $atm_id;
										$_new_arr_data[] = $_circleName;
										$_new_arr_data[] = $_Zone;
										$_new_arr_data[] = $sql_result['State'];
										$_new_arr_data[] = $site_address;
										$_new_arr_data[] = $site_type;
										$_new_arr_data[] = "PIN Hole Camera";
										$_pin_tot_uptime = 0;
										 for($i=0;$i<count($_dt_range);$i++){ 
											$_pin_cam_dt = $_dt_range[$i];
											if (array_key_exists($_pin_cam_dt,$_cam4_arr)){
												$_pin_tot_uptime = $_pin_tot_uptime + $_cam4_arr[$_pin_cam_dt];
												$_new_arr_data[] = $_cam4_arr[$_pin_cam_dt];
											}else{
											    $_new_arr_data[] = 0;	
											}
										}
										 $total_cam4_downtime = $total_timemonth - $_pin_tot_uptime;
										 $_new_arr_data[] = $_pin_tot_uptime;
										 $_new_arr_data[] = $total_cam4_downtime;
										array_push($_array_data,$_new_arr_data);
										
							  }
						   }
						 }
								  
		  CloseCon($con);
		  $array = array('Code'=>200,'newcolumn_array'=>$newcolumn_array,'array_data'=>$_array_data);
		  echo json_encode(utf8ize($array));
		 // echo json_encode($array);
		?>
                      

