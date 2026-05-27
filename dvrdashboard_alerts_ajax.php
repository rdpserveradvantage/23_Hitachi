<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); $con = OpenCon();
function getPanelName($panelid,$con){
//	global $con;
//	$con = OpenCon();
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
//	CloseCon($con);
	return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
   // global $con;
	//$con = OpenCon();
	$panel_name = getPanelName($panelid,$con);
	$paramater = 'SensorName';
	$sql = "";
	$_change = 0;
	if($panel_name=='comfort'){
		if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from comfort where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='rass_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from rass_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_boi'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_boi where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
	if($panel_name=='smarti_pnb'){
		if(substr($alarm, -1)=='R'){
			$_change = 1;
			$remain_char = substr($alarm, 0,-1);
		    $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE LIKE '".$remain_char."%'");	
		}else{
		   $sql = mysqli_query($con,"select $paramater from smarti_pnb where ZONE='".$zone."' AND SCODE='".$alarm."'");
		}
	}
    if($panel_name=='RASS'){
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND status=0");
	}
    if($panel_name=='rass_cloud'){
		$sql = mysqli_query($con,"select $paramater from rass_cloud where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_cloudnew'){
		$sql = mysqli_query($con,"select $paramater from rass_cloudnew where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='rass_sbi'){
		$sql = mysqli_query($con,"select $paramater from rass_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SEC'){
		$sql = mysqli_query($con,"select $paramater from securico where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='securico_gx4816'){
		$sql = mysqli_query($con,"select $paramater from securico_gx4816 where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='sec_sbi'){
		$sql = mysqli_query($con,"select $paramater from sec_sbi where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='Raxx'){
		$sql = mysqli_query($con,"select $paramater from raxx where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART -I'){
		$sql = mysqli_query($con,"select $paramater from smarti where ZONE='".$zone."' AND status=0");
	}
	if($panel_name=='SMART-IN'){
		$sql = mysqli_query($con,"select $paramater from smartinew where ZONE='".$zone."' AND status=0");
	}
	if($sql==""){
		$return = "";
	}else{
		if(mysqli_num_rows($sql)>0){
	        $sql_result = mysqli_fetch_assoc($sql);
	        if($_change == 1){
				if($panel_name=='comfort'){
		            if(substr($alarm, -1)=='R' || substr($alarm, -1)=='N'){
						$return = $sql_result[$paramater]." Restoral";
					}
				}
				else{	
				   if(substr($alarm, -1)=='R'){
					$return = $sql_result[$paramater]." Restoral";
				   }
				}
				
		    } else{
		        $return = $sql_result[$paramater];
			}
		}else{
			$return = "";
		}
		
	}
	return $return;
  
}
?>
<?php 
$client = $_POST['client'];

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
		}

$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$circle = $_POST['circle'];
$query_date = date('Y-m-d');
$splitdate = explode("-",$query_date);
$day = $splitdate[2];
$month = $splitdate[1];
$year = $splitdate[0];

$end_day = intval($day);



	
	if($atmid!=''){
		$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql_result = mysqli_fetch_assoc($count_sql);
		$_panelid = $count_sql_result['NewPanelID'];
	}else{
		if($bank!=''){
			if($circle!=''){
				$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
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
		 // $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		  //$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		}else{
			$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
		if(mysqli_num_rows($count_sql)>0){
			while($count_sql_result = mysqli_fetch_assoc($count_sql)){
				if($count_sql_result['NewPanelID']!=''){
					$_is_atmid = $count_sql_result['ATMID'];
					if(count($_circle_name_array)==0){
						$atmidarray[] = $count_sql_result['NewPanelID'];
					}else{
						if(in_array($_is_atmid,$_circle_name_array)){
						   $atmidarray[] = $count_sql_result['NewPanelID'];
						}
					}
				 // $atmidarray[] = $count_sql_result['NewPanelID'];
				}
			}
		}else{
			$atmidarray = [];
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	} 


    if($atmid!=''){ 
	    $testsql = "SELECT COUNT(id) as cnt,alarm,panelid,zone FROM alerts WHERE panelid ='".$_panelid."' AND sendtoclient='S' AND (status='C' OR status='O') GROUP BY alarm,zone ORDER BY `id`  DESC"; 
	}else{
		$testsql = "SELECT COUNT(id) as cnt,alarm,panelid,zone FROM alerts WHERE panelid IN (".$atmidarray.") AND sendtoclient='S' AND (status='C' OR status='O') GROUP BY alarm,zone ORDER BY `id`  DESC"; 
	}
				
	$alert_type_query = mysqli_query($con,$testsql);
	$res_data = [];
	$pielabeldata_array = [];
    $pielabel_array = [];
    if(mysqli_num_rows($alert_type_query)>0){
		$j = 0;
		while($alert_type_query_result = mysqli_fetch_assoc($alert_type_query)){
            $sitepanelid= $alert_type_query_result['panelid'];	
            $sitezone= $alert_type_query_result['zone'];
            $ticketcount = $alert_type_query_result['cnt'];	
            $alarm= $alert_type_query_result['alarm'];			
		    $sensor_name = get_sensor_name($sitezone,$sitepanelid,$con,$alarm);
			$data = [];
			$data[0] = $sensor_name;
			$data[1] = $ticketcount;
			$res_data[$j] = $data;
			array_push($pielabel_array,$sensor_name);
		    array_push($pielabeldata_array,$ticketcount);
			$j++;
		}
	}

$_sql = $sql;
$alert_resolved_count = 0;
$alert_unresolved_count = 0;
$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
$labeldata_array = [];
$label_array = [];
if(mysqli_num_rows($sql)){
	while($sitesql_result = mysqli_fetch_assoc($sql)){
		$atm_id = $sitesql_result['ATMID'];
		$_view = 0;
		if(count($_circle_name_array)==0){
			$_view = 1;
		}else{
			if(in_array($atm_id,$_circle_name_array)){
			   $_view = 1;
			}
		}
		if($_view == 1){
			$panelid = $sitesql_result['NewPanelID'];
			$siteaddress = $sitesql_result['SiteAddress'];
			$alerts_sql = "SELECT id,status,sendtoclient FROM alerts WHERE panelid ='".$panelid."'"; 
			
			/*$testsql = "SELECT * FROM dvrcommunicationdetails_test WHERE DVRIP ='".$dvrip."' AND CAST(DVRConnectDatetime AS DATE)>='".$start."' 
					   AND CAST(DVRConnectDatetime AS DATE)<='".$end."'"; */
			$dvrhis_query = mysqli_query($con,$alerts_sql); 
		
		
		
			$totaldvrconnect = mysqli_num_rows($dvrhis_query);   
			if(mysqli_num_rows($dvrhis_query)>0){
				while($dvr_sql_result = mysqli_fetch_assoc($dvrhis_query)){
					$status = $dvr_sql_result['status'];
					$sendtoclient = $dvr_sql_result['sendtoclient'];
					if (!empty($status)) {
						
						if ($status=='C' && $sendtoclient=='S') { 
						   $alert_resolved_count = $alert_resolved_count + 1;
						}
						if ($status=='O' && $sendtoclient=='S') { 
						   $alert_unresolved_count = $alert_unresolved_count + 1;
						}
					}
					
					
				}
				
			}
		}
		
	}
	
	for($i=1;$i<=$end_day;$i++){
		if($i<10){
			$createday = "0".$i;
		}else{
			$createday = $i;
		}
		
		$create_date = $year."-".$month."-".$createday;
		$labeldata = 0;
		while($_sitesql_result = mysqli_fetch_assoc($_sql)){
			$atm_id = $_sitesql_result['ATMID'];
			$_view = 0;
			if(count($_circle_name_array)==0){
				$_view = 1;
			}else{
				if(in_array($atm_id,$_circle_name_array)){
				   $_view = 1;
				}
			}
			if($_view == 1){
				$_panelid = $_sitesql_result['NewPanelID'];
				
				$_alerts_sql = "SELECT id,status,sendtoclient FROM alerts WHERE panelid ='".$_panelid."' AND CAST(createtime AS DATE)='".$create_date."'";

				$d_query = mysqli_query($con,$_alerts_sql); 
			
				$total_connect = mysqli_num_rows($d_query);   
				if(mysqli_num_rows($d_query)>0){
					while($d_sql_result = mysqli_fetch_assoc($d_query)){
						$total_ticket = 0;
						$_status = $d_sql_result['status'];
						$_sendtoclient = $d_sql_result['sendtoclient'];
						if (!empty($_status)) {
							
							if ($_status=='C' && $_sendtoclient=='S') { 
							   $_alert_resolved_count = $_alert_resolved_count + 1;
							}
							if ($_status=='O' && $_sendtoclient=='S') { 
							   $_alert_unresolved_count = $_alert_unresolved_count + 1;
							}
							$total_ticket = $_alert_resolved_count + $_alert_unresolved_count;
						}
						$labeldata = $labeldata + $total_ticket;
						
					}
					
				}
			}
		}
		$label = strval($i);
		array_push($label_array,$label);
		array_push($labeldata_array,$labeldata);			
	}
}

$totalalerts = $alert_resolved_count + $alert_unresolved_count;
$alert_active_percent = 0;
$alert_closed_percent = 0;
if($totalalerts>0){
	$alert_active_percent = ($alert_unresolved_count/$totalalerts)*100;
	$alert_active_percent = number_format((float)$alert_active_percent, 2, '.', '');
	$alert_closed_percent = ($alert_resolved_count/$totalalerts)*100;
    $alert_closed_percent = number_format((float)$alert_closed_percent, 2, '.', '');
}



$array = array(['alert_resolved_count'=>$alert_resolved_count,'alert_unresolved_count'=>$alert_unresolved_count,'label_data'=>$labeldata_array,'label'=>$label_array,
                 'totalalerts'=>$totalalerts,'alert_active_percent'=>$alert_active_percent,'alert_closed_percent'=>$alert_closed_percent,'res_data'=>$res_data,
				 'pielabel_array'=>$pielabel_array,'pielabeldata_array'=>$pielabeldata_array,'test'=>$testsql]);
CloseCon($con);
echo json_encode($array);
?>


