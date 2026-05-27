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
		
	if($sql==''){ return '-';}else{
	    $sql_result = mysqli_fetch_assoc($sql);
     	return $sql_result[$paramater];
	}
}

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
	$_panel_ids_arr = [];
	if($atmid!=''){
		//$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$_sql = $count_sql; 
		$count_sql_result = mysqli_fetch_assoc($count_sql);
		$_panelid = $count_sql_result['NewPanelID'];
		array_push($_panel_ids_arr, $_panelid);
		$_alerts_sql = "SELECT id,status,sendtoclient FROM alerts WHERE panelid ='".$_panelid."' AND sendtoclient='S' AND (status='C' OR status='O')";
        $d_query = mysqli_query($con,$_alerts_sql); 
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
				//	$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		            $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
			}else{ 
			   //  $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		         $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
		 
		}else{
			//$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
		$_sql = $count_sql; 
		$sql = $count_sql; 
		while($count_sql_result = mysqli_fetch_assoc($count_sql)){
			if($count_sql_result['NewPanelID']!='' && $count_sql_result['NewPanelID']!='-'){
				$atmidarray[] = $count_sql_result['NewPanelID'];
				$panelid = $count_sql_result['NewPanelID']; 
				array_push($_panel_ids_arr, $panelid);
			}
			
		    $atmCodearray[] = $count_sql_result['ATMID'];	
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
		$_alerts_sql = "SELECT id,status,sendtoclient,panelid,createtime FROM alerts WHERE panelid IN (".$atmidarray.") AND sendtoclient='S' AND (status='C' OR status='O')";
       // echo $_alerts_sql;die;
		$d_query = mysqli_query($con,$_alerts_sql); 
	} 

   //echo mysqli_num_rows($d_query);die;

$alert_resolved_count = 0;
$alert_unresolved_count = 0;
$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
$labeldata_array = [];
$label_array = [];
$ticketcountarray = [];
$ticketvaluearray = [];

if(mysqli_num_rows($d_query)){
	
	$j = 0; 
	for($i=1;$i<=$end_day;$i++){
		if($i<10){
			$createday = "0".$i;
		}else{
			$createday = $i;
		}
		
		$create_date = $year."-".$month."-".$createday;

		$label = strval($i);
		array_push($label_array,$label);
	//	array_push($labeldata_array,$labeldata);

        $labeldata = 0;
        $_ticket_value = [];
		$_ticket_value['x'] = $label;
		$_ticket_value['y'] = $labeldata;
        array_push($ticketvaluearray,$_ticket_value); 
	}

	//echo '<pre>';print_r($ticketvaluearray);echo '</pre>';
	$labeldata = 0;
	while($_sitesql_result = mysqli_fetch_assoc($d_query)){
		
		$_createtime = $_sitesql_result['createtime'];
		$_createdatewithoutTime = explode(" ",$_createtime);
		$create_date = explode("-",$_createdatewithoutTime[0]);
		$_alert_resolved_count = 0;$_alert_unresolved_count = 0;
		$create_date_day = $create_date[2];
		$create_date_day = strval($create_date_day);
		$_status = $_sitesql_result['status'];
		
		if($create_date_day<=$end_day){
				
			if ($_status=='C') { 
				$_alert_resolved_count = $_alert_resolved_count + 1;
				$alert_resolved_count = $alert_resolved_count + 1;
			}
			if ($_status=='O') { 
				$_alert_unresolved_count = $_alert_unresolved_count + 1;
				$alert_unresolved_count = $alert_unresolved_count + 1;
			}
			$total_ticket = $_alert_resolved_count + $_alert_unresolved_count;
				//	echo $create_date_day;die;
			$ticketvaluearray[$create_date_day - 1]['y'] = $ticketvaluearray[$create_date_day - 1]['y'] + $total_ticket;
		}
	}
	//echo '<pre>';print_r($ticketvaluearray);echo '</pre>';	
		//die;
	
	//echo '<pre>';print_r($ticketvaluearray);echo '</pre>';die;
	$_ticket_value_arr = [];
	$_ticket_value_arr['values'] = $ticketvaluearray;	
	$_ticket_value_arr['label'] = 'Ticket Count List';
    array_push($ticketcountarray,$_ticket_value_arr); 
}

$totalalerts = $alert_resolved_count + $alert_unresolved_count;
if($totalalerts==0){
	$alert_active_percent = 0;
	$alert_closed_percent = 0;
}else{
$alert_active_percent = ($alert_unresolved_count/$totalalerts)*100;
$alert_active_percent = number_format((float)$alert_active_percent, 2, '.', '');

$alert_closed_percent = ($alert_resolved_count/$totalalerts)*100;
$alert_closed_percent = number_format((float)$alert_closed_percent, 2, '.', '');
}

$_res_data = array();

$array = array(['alert_resolved_count'=>$alert_resolved_count,'alert_unresolved_count'=>$alert_unresolved_count,'label_data'=>$labeldata_array,'label'=>$label_array,
                 'totalalerts'=>$totalalerts,'ticketcountarray'=>$ticketcountarray,'alert_active_percent'=>$alert_active_percent,'alert_closed_percent'=>$alert_closed_percent,]);
CloseCon($con);
//echo json_encode($array);
echo json_encode(utf8ize($array));
?>


