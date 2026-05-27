<?php //include('config.php'); ?>
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
	if($panel_name=='rass_boi'){
		$sql = mysqli_query($con,"select $paramater from rass_boi where ZONE='".$zone."'");
	}
	
	
	if($sql==''){ return '-';}else{
	$sql_result = mysqli_fetch_assoc($sql);
  //  CloseCon($con);
	return $sql_result[$paramater];
	}
}
?>
<?php 
$client = $_POST['client'];

       $userid = $_POST['user_id'];
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


 $bank = "";
   $atmid = "";
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
			$atmidarray[] = $count_sql_result['NewPanelID'];
		    $atmCodearray[] = $count_sql_result['ATMID'];	
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
	$res_data = array();
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
			$data = array();
			//$data = new stdClass();
			$data['value'] = $ticketcount;
			$data['label'] = $sensor_name;
			
			//$data = ['label'=>$sensor_name,'value'=>$ticketcount];
			$res_data[$j] = (object)$data;
			
			//array_push($res_data,$data);			
			array_push($pielabel_array,$sensor_name);
		    array_push($pielabeldata_array,$ticketcount);
			$j++;
		}
	}
	
	$_res_data = array();
	if($atmid!=''){ 
	    $aisql = mysqli_query($con,"select COUNT(id) as cnt,alerttype,File_loc,createtime,ATMCode from ai_alerts where ATMCode like '%".$atmid."%' GROUP BY ATMCode,alerttype"); 
		if(mysqli_num_rows($aisql)>0){
			$j = 0;
			
			while($aisql_result = mysqli_fetch_assoc($aisql)){
			   $cnt = 0;
			   $alert_type = $aisql_result['alerttype'];
			   $single_aisql = mysqli_query($con,"select alerttype,File_loc,createtime,ATMCode from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype like '%".$alert_type."%'");
			   if(mysqli_num_rows($single_aisql)>0){
			     while($ai_sql_result = mysqli_fetch_assoc($single_aisql)){
			        
					$createdatetime = $ai_sql_result['createtime'];
					if($ai_sql_result['File_loc']!=''){
						if($createdatetime!=''){
							$datetime1 = new DateTime();
							$datetime2 = new DateTime($createdatetime);
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
							if($not>0){
								//$camera_notworking_count = $camera_notworking_count + 1;
							}else{
								if($elapsedhr<=24){
									$cnt = $cnt + 1;	
									 
									
								}
							}
						}
					   
					}
			    }
			 }
			    $_data = [];	
				$_data['value'] = $cnt; 
				$_data['label'] = ltrim($alert_type);
				$_res_data[$j] = (object)$_data;
				//array_push($res_data,$_data);
				$j++;
			 
			 
			}
		}
	}else{
		$aisql = mysqli_query($con,"select COUNT(id) as cnt,alerttype,File_loc,createtime,ATMCode from ai_alerts GROUP BY ATMCode,alerttype"); 
		if(mysqli_num_rows($aisql)>0){
			$j = 0;
			$alert_type_key = array();
			while($aisql_result = mysqli_fetch_assoc($aisql)){
				$final_count = 0;
			   $alert_type_name = ltrim($aisql_result['alerttype']);	
			   $atm_code = ltrim($aisql_result['ATMCode']);
			    if($alert_type_name!='alive-status'){
				if (in_array($atm_code, $atmCodearray)){
				   $cnt = 0;
				   $alert_type = $aisql_result['alerttype'];
				   if (array_key_exists($alert_type,$alert_type_key)){
					   
				   }else{
					   $alert_type_key[$alert_type] = 0;
				   }
				   
				   $single_aisql = mysqli_query($con,"select alerttype,File_loc,createtime,ATMCode from ai_alerts where ATMCode like '%".$atm_code."%' AND alerttype like '%".$alert_type."%'");
				   if(mysqli_num_rows($single_aisql)>0){
					 while($ai_sql_result = mysqli_fetch_assoc($single_aisql)){
						
						$createdatetime = $ai_sql_result['createtime'];
						if($ai_sql_result['File_loc']!=''){
							if($createdatetime!=''){
								$datetime1 = new DateTime();
								$datetime2 = new DateTime($createdatetime);
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
								if($not>0){
									//$camera_notworking_count = $camera_notworking_count + 1;
								}else{
									if($elapsedhr<=24){
										$cnt = $cnt + 1;	
										 
										
									}
								}
							}
						   
						}
					 }
				   }

				   $alert_type_key[$alert_type] = $alert_type_key[$alert_type] + $cnt;
				   
				
				}
			  }
			}
			
			$alert_type_arr_count=count($alert_type_key);
			
			$i = 0;
			foreach($alert_type_key as $key=>$val){
				$_data = [];	
				$_data['value'] = $val; 
				$_data['label'] = $key;
				if($val>0){
				$_res_data[$i] = (object)$_data;
				$i++;
				}
			}
			
			
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
$ticketcountarray = [];
$ticketvaluearray = [];
if(mysqli_num_rows($sql)){
	while($sitesql_result = mysqli_fetch_assoc($sql)){
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
	$j = 0;
	for($i=1;$i<=$end_day;$i++){
		if($i<10){
			$createday = "0".$i;
		}else{
			$createday = $i;
		}
		
		$create_date = $year."-".$month."-".$createday;
		$labeldata = 0;
		while($_sitesql_result = mysqli_fetch_assoc($_sql)){
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
		$label = strval($i);
		array_push($label_array,$label);
		array_push($labeldata_array,$labeldata);

        $_ticket_value = [];
		$_ticket_value['x'] = $label;
		$_ticket_value['y'] = $labeldata;
        array_push($ticketvaluearray,$_ticket_value); 
		 		
        		
	}
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



$array = array(['alert_resolved_count'=>$alert_resolved_count,'alert_unresolved_count'=>$alert_unresolved_count,'label_data'=>$labeldata_array,'label'=>$label_array,
                 'totalalerts'=>$totalalerts,'alert_active_percent'=>$alert_active_percent,'alert_closed_percent'=>$alert_closed_percent,'res_data'=>$res_data,
				 'pielabel_array'=>$pielabel_array,'pielabeldata_array'=>$pielabeldata_array,'ticketcountarray'=>$ticketcountarray,'ai_res_data'=>$_res_data]);
CloseCon($con);
//echo json_encode($array);
echo json_encode(utf8ize($array));
?>


