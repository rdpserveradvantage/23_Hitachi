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
$start_date = '2023-04-10'; $end_date = '2023-04-26';
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
//	$start_date = "";$end_date = "";
for($d=1; $d<=31; $d++)
{
    $time=mktime(12, 0, 0, $month, $d, $year);          
    if (date('m', $time)==$month){       
        $list[]=date('Y-m-d-D', $time);
		if($d==1){
			$_first_date_month = date('Y-m-d', $time);
			//$start_date = $_first_date_month;
		}
		$list1[]=date('Y-m-d', $time);
		$_last_date_month = date('Y-m-d', $time);
		//$end_date = $_last_date_month;
		$uptime_arr[] = 0;
		$downtime_arr[] = 0;
	}
}

if($atmid!=''){
	$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,s.NewPanelID,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.ATMID='".$atmid."' and live='Y' GROUP BY s.SN";
	
}else{
	if($bank!=''){
		    if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle_new where Circle='".$circle."'");
				$circleatmidarray = [];
				while($circlesql_result = mysqli_fetch_assoc($circlesql)){
					$circleatmidarray[] = $circlesql_result['ATMID'];
					
				}
				$circleatmidarray=json_encode($circleatmidarray);
				$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
				$circlearr=explode(',',$circleatmidarray);
				$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,s.NewPanelID,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.ATMID IN (".$circleatmidarray.") and s.live='Y' GROUP BY s.SN";	
			   
			}else{
				$sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,s.NewPanelID,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank='".$bank."' and s.live='Y' GROUP BY s.SN";	
		        
			} 
	  
	}else{
		if($client=='All'){
			
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,s.NewPanelID,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.live='Y' GROUP BY s.SN";	
		}else{
		
		   $sql_qry = "select s.ATMID,s.SN,s.SiteAddress,s.DVRIP,s.PanelIP,s.RouterIp,s.ATMID_2,s.ATMID_3,s.live_date,s.Zone,s.State,s.NewPanelID,sc.Circle,sc.site_type from sites s left join site_circle_new sc ON s.ATMID = sc.ATMID where s.Customer='".$client."' and s.Bank IN (".$_bank_name.") and s.live='Y' GROUP BY s.SN";
	    }
	}
	
}
 
 $sql = mysqli_query($con,$sql_qry);
 
 $newcolumn_array = array();
 $column_array = array();
 $column_array = ["S.N","Date","ATM-ID","Circle","Region","State","Location","Site Type","Event Occurrence","Event Closure Time","Nature of Alarm","Total time taken to close","Whether 2-way audio used","Operator Comments"];
 $column_name_array = ["First","Second","Third","Fourth","Fifth","Sixth","Seventh"];
 $j = count($column_name_array);
 
 for($i=0;$i<count($column_array);$i++){
	 $_new_arr = array();
	 $_new_arr['title'] = $column_array[$i];
	 array_push($newcolumn_array,$_new_arr);
 }
 
 $yesterday = date('Y-m-d',strtotime("-1 days"));
						      $today = date('Y-m-d');
							  $_array_data = array();
                              $last_date =  date("Y-m-t", strtotime($_first_date_month));
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
								$_view = 1;
								/*
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
								if($live_dt > $last_date){
									$_view = 0;
								}
								if($live_dt_year==$this_year){
									if($live_dt_month==$this_month){
										$_view = 0;
									}
								}  */
								if($_view == 1){
									$site_address = $sql_result['SiteAddress'];
									
									$_Zone = $sql_result['Zone'];
									$_circleName = $sql_result['Circle'];
									$sn = $sql_result['SN'];
									$site_live_date = $sql_result['live_date'];
									$_State = $sql_result['State'];
									
									
									
									$total_uptime = 0;$total_downtime = 0;
									$tot_cnt = 0;$tot_daycnt = 0; $is_lies = 0;
									
									$net_qry_sql = "SELECT * FROM `newalert_report` WHERE SN='" . $sn . "' AND month_date>='" . $start_date . "' AND month_date<='" . $end_date . "' ";
									$net_sql_res = mysqli_query($con, $net_qry_sql);
									$total_time = 0;
									$total_net_his = mysqli_num_rows($net_sql_res);
									$net_his_not = 0;
									$atlastmonthdate = '';
									if ($total_net_his > 0) {
										while ($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)) {
											$_mnth_dt = $net_his_sql_result['month_date'];
											$count++;
                                            $createdatetime = $net_his_sql_result['event_occurence'];
											$alert_type = $net_his_sql_result['alert_type'];
										    $closedatetime = $net_his_sql_result['event_closure'];
											$is_2way_audio_used = $net_his_sql_result['is_2way_audio_used'];
											$comment = $net_his_sql_result['comments'];
										    $duration = "";
										    if($createdatetime!='' && $closedatetime!=''){
												$datetime1 = new DateTime($closedatetime);
												$datetime2 = new DateTime($createdatetime);
												$interval = $datetime1->diff($datetime2);
												
												$elapsedyear = $interval->format('%y');
												$elapsedmon = $interval->format('%m');
												$elapsed_day = $interval->format('%a');
												$elapsedhr = $interval->format('%h');
												$elapsedmin = $interval->format('%i');
												$elapsedsec = $interval->format('%s');
												
												if($elapsedhr<10){
													$elapsedhr = "0".$elapsedhr;
												}
												if($elapsedmin<10){
													$elapsedmin = "0".$elapsedmin;
												}
												if($elapsed_day>0){
													$elapsed_day = $elapsed_day." Days";
													$duration = $elapsed_day." ".$elapsedhr.":".$elapsedmin;
												}else{
													$duration = $elapsedhr.":".$elapsedmin;
												}
												
											}
											
											$_new_arr_data = array();
											$_new_arr_data[] = $count;
											$_new_arr_data[] = $_mnth_dt;
											$_new_arr_data[] = $atm_id;
											$_new_arr_data[] = $_circleName;
											$_new_arr_data[] = $_Zone;
											$_new_arr_data[] = $_State;
											$_new_arr_data[] = $site_address;
											$_new_arr_data[] = $site_type;
											$_new_arr_data[] = $createdatetime;
											$_new_arr_data[] = $closedatetime;
											$_new_arr_data[] = $alert_type;
											$_new_arr_data[] = $duration;
											$_new_arr_data[] = $is_2way_audio_used;
											$_new_arr_data[] = $comment;
											array_push($_array_data,$_new_arr_data);
											 
										}
										
										echo '<pre>';print_r($_array_data);echo '</pre>';die;
									}
									
							
							  }
						   }
						 }
						  CloseCon($con);
						  
						  $array = array('Code'=>200,'newcolumn_array'=>$newcolumn_array,'array_data'=>$_array_data);
		  echo json_encode(utf8ize($array));
?>
			  

