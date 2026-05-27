<?php include('db_connection.php'); 
function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
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
   // global $con;
	//$con = OpenCon();
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
	if($panel_name=='rass_pnb'){
		$sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
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
	
	
	if($sql==''){ return '-';}else{
	$sql_result = mysqli_fetch_assoc($sql);
  //  CloseCon($con);
	return $sql_result[$paramater];
	}
}
?>
<?php 
//$client = $_POST['client'];
$client = "Hitachi";
    //   $userid = $_POST['user_id'];
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
$splitdate = explode("-",$query_date);
$day = $splitdate[2];
$month = $splitdate[1];
$year = $splitdate[0];

$end_day = intval($day);



	$con = OpenCon();
	if($atmid!=''){
		$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql_result = mysqli_fetch_assoc($count_sql);
		$_panelid = $count_sql_result['NewPanelID'];
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
					$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		            $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
			}else{ 
			     $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		         $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
		 
		}else{
			$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
		
		while($count_sql_result = mysqli_fetch_assoc($count_sql)){
			if($count_sql_result['NewPanelID']!='' && $count_sql_result['NewPanelID']!='-'){
			$atmidarray[] = $count_sql_result['NewPanelID'];
			}
		    $atmCodearray[] = $count_sql_result['ATMID'];	
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	} 

 // echo '<pre>';print_r($atmidarray);echo '</pre>';die;
    if($atmid!=''){ 
	    $testsql = "SELECT COUNT(id) as cnt,alarm,panelid,zone FROM alerts WHERE panelid ='".$_panelid."' AND sendtoclient='S' AND (status='C' OR status='O') AND CAST(receivedtime AS DATE)>='".$query_date."' GROUP BY alarm,zone ORDER BY `id`  DESC"; 
	}else{
		$testsql = "SELECT COUNT(id) as cnt,alarm,panelid,zone FROM alerts WHERE panelid IN (".$atmidarray.") AND sendtoclient='S' AND (status='C' OR status='O') AND CAST(receivedtime AS DATE)>='".$query_date."' GROUP BY alarm,zone ORDER BY `id`  DESC"; 
	}
			//echo $testsql;die;
	$alert_type_query = mysqli_query($con,$testsql);
	$res_data = array();
	$pielabeldata_array = [];
    $pielabel_array = [];
	//echo mysqli_num_rows($alert_type_query);
    if(mysqli_num_rows($alert_type_query)>0){
		$j = 0;
		while($alert_type_query_result = mysqli_fetch_assoc($alert_type_query)){
            $sitepanelid= $alert_type_query_result['panelid'];	
            $sitezone= $alert_type_query_result['zone'];
            $ticketcount = $alert_type_query_result['cnt'];	
            $alarm= $alert_type_query_result['alarm'];		
           // echo $sitepanelid."_".$sitezone."_".$ticketcount."_".$alarm;die;			
		    $sensor_name = get_sensor_name($sitezone,$sitepanelid,$con,$alarm);
			if($sensor_name=='-' || $sensor_name=='' ){
				
			}else{
				$data = array();
				//$data = new stdClass();
				$data['value'] = $ticketcount;
				$data['label'] = $sensor_name;
				
				//echo array_search($sensor_name, $pielabel_array); 
				
				//$data = ['label'=>$sensor_name,'value'=>$ticketcount];
				$res_data[$j] = (object)$data;
				
				//array_push($res_data,$data);			
				array_push($pielabel_array,$sensor_name);
				array_push($pielabeldata_array,$ticketcount);
				$j++;
			}
		}
	}


$_res_data = array();

$array = array(['res_data'=>$res_data,
				 'pielabel_array'=>$pielabel_array,'pielabeldata_array'=>$pielabeldata_array,'ai_res_data'=>$_res_data]);
CloseCon($con);
//echo json_encode($array);
echo json_encode(utf8ize($array));
?>


