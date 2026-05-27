<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

//$month = $_GET['month'];
//$year = $_GET['year'];

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
 $column_array = array();
 $new_obj = array();
 $new_obj['title'] = "S.No.";
 $new_obj['name'] = "first";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "ATM-ID";
 $new_obj['name'] = "second";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "Circle";
 $new_obj['name'] = "third";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "ZO";
 $new_obj['name'] = "fourth";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "State";
 $new_obj['name'] = "fifth";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "Location";
 $new_obj['name'] = "sixth";
 array_push($column_array,$new_obj);
 $new_obj = array();
 $new_obj['title'] = "Site Type";
 $new_obj['name'] = "seventh";
 array_push($column_array,$new_obj);
 for($i=0;$i<count($_dt_range);$i++){
	 $new_obj = array();
	 $new_obj['title'] = $_dt_range[$i];
	 array_push($column_array,$new_obj);
 }
 $new_obj = array();
 $new_obj['name'] = "Total Up";
  array_push($column_array,$new_obj);
  $new_obj = array();
 $new_obj['name'] = "Total Down";
  array_push($column_array,$new_obj);

 $yesterday = date('Y-m-d',strtotime("-1 days"));
		  $today = date('Y-m-d');
		 
		  $last_date =  date("Y-m-t", strtotime($_first_date_month));
	$count = 0; 
	$data_array = array();
	/*
	 if(mysqli_num_rows($sql)){
		while($sql_result = mysqli_fetch_assoc($sql)){
			$_new_arr = array();
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
				
				$_Zone = $sql_result['Zone'];
				$_circleName = $sql_result['Circle'];
				$sn = $sql_result['SN'];
				$site_live_date = $sql_result['live_date'];
				$_State = $sql_result['State'];
				
				$count++;
			
				$total_uptime = 0;$total_downtime = 0;
				$tot_cnt = 0;$tot_daycnt = 0; $is_lies = 0;
				
				array_push($_new_arr,$count);
				array_push($_new_arr,$atm_id);
				array_push($_new_arr,$_circleName);
				array_push($_new_arr,$_Zone);
				array_push($_new_arr,$_State);
				array_push($_new_arr,$site_address);
				array_push($_new_arr,'-');
				
				for($i=0;$i<count($_dt_range);$i++){
					array_push($_new_arr,'24');
				}
				array_push($_new_arr,'24');
				array_push($_new_arr,'0');
				
				array_push($data_array,$_new_arr);
		  }
	   }
	 }   */
	CloseCon($con);
	$result_data = array(['data1'=>$data_array,'data2'=>$column_array]);
	echo json_encode($result_data);
								?>
                      

