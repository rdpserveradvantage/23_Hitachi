<?php include('db_connection.php'); 
function getPanelName($panelid,$con){
    $sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['Panel_Make'];
}
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
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
   
	$sql = "";
	$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
	}
		
	if($sql==''){ 
	   return '-';
	}else{
	   $sql_result = mysqli_fetch_assoc($sql);
       return $sql_result[$paramater];
	}
}
?>
<?php 
//$client = $_POST['client'];
$client = "Hitachi";
     //  $userid = $_POST['user_id'];
	   $userid='24';
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
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


 $bank = "PNB";
   $atmid = "";$circle = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
$query_date = date('Y-m-d');
$start_date = date('Y-m-01');

$splitdate = explode("-",$query_date);
$day = $splitdate[2];
$month = $splitdate[1];
$year = $splitdate[0];

$end_day = intval($day);


$panel_id_arr = array();
	$con = OpenCon();
	if($atmid!=''){
		$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql_result = mysqli_fetch_assoc($count_sql);
		$_panelid = $count_sql_result['NewPanelID'];
		array_push($panel_id_arr ,$_panelid);
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
					$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
			}else{ 
			     $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
		 
		}else{
			$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
		
		while($count_sql_result = mysqli_fetch_assoc($count_sql)){
			$atmidarray[] = $count_sql_result['NewPanelID'];
		    $atmCodearray[] = $count_sql_result['ATMID'];	
			array_push($panel_id_arr ,$count_sql_result['NewPanelID']);
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	} 
	
	$res_data = array();
	$pielabeldata_array = [];
    $pielabel_array = [];
	
	$_alert_query = "SELECT id,alarm,panelid,zone FROM alerts WHERE sendtoclient='S' AND (status='C' OR status='O') AND CAST(receivedtime AS DATE)>='".$start_date."' AND CAST(receivedtime AS DATE)<='".$query_date."' ORDER BY `id` DESC"; 
	$alert_data = mysqli_query($con,$_alert_query);
	while($alert_data_sql_result = mysqli_fetch_assoc($alert_data)){
		$sitepanelid = $alert_data_sql_result['panelid'];
		if(in_array($sitepanelid,$panel_id_arr)){
			$sitezone= $alert_data_sql_result['zone'];
            //$ticketcount = $alert_type_query_result['cnt'];	
            $alarm= $alert_data_sql_result['alarm'];			
		    $sensor_name = get_sensor_name($sitezone,$sitepanelid,$con,$alarm);
			if($sensor_name!='' && $sensor_name!='-'){
				if(in_array($sensor_name,$pielabel_array)){
					$key = array_search ($sensor_name, $arr);
					$old_val = $pielabeldata_array[$key];
					$new_val = $old_val + 1;
					$pielabeldata_array[$key] = $new_val;
				}else{
					array_push($pielabel_array,$sensor_name);
					array_push($pielabeldata_array,1);
				}
			}
		}
	}
	echo '<pre>';print_r($pielabel_array);echo '</pre>';
	echo '<pre>';print_r($pielabeldata_array);echo '</pre>';