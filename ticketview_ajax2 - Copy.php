<?php

session_start();include('db_connection.php'); 
function getPanelName($panelid,$con){
	$sql = mysqli_query($con,"select Panel_Make from sites where NewPanelID='".$panelid."'");
	$sql_result = mysqli_fetch_assoc($sql);
    return $sql_result['Panel_Make'];
}
 
function get_sensor_name($zone,$panelid,$con,$alarm)
{
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
		$sql = mysqli_query($con,"select $paramater from rass where ZONE='".$zone."' AND SCODE='".$alarm."'");
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

					  
	// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'ATMID',
		1 =>'panelid', 
		2 => 'location',
		3 => 'address',
		4 =>'state', 
		5 => 'city',
		6 => 'branch_code',
		7 =>'alert_type', 
		8 => 'alarm',
		9 => 'zone',
		10 =>'createdatetime', 
		11 => 'closedatetime',
	    12 => 'duration',
		13 =>'dvrip', 
		14 => 'comment',
		15 => 'id',
		16 => 'closedby'
	);

	$where = $sqlTot = $sqlRec = "";

	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( employee_name LIKE '".$params['search']['value']."%' ";    
		$where .=" OR employee_salary LIKE '".$params['search']['value']."%' ";

		$where .=" OR employee_age LIKE '".$params['search']['value']."%' )";
	}

	// getting total number records without any search
	$client = $params['client'];
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

	 $bank = "";
	   $atmid = "";
	if(isset($params['bank'])){
	$bank = $params['bank'];
	}
	if(isset($params['atmid'])){
	$atmid = $params['atmid'];
	}
	$con = OpenCon();

	if($atmid!=''){
		$sitesql = mysqli_query($con,"select NewPanelID from sites where atmid='".$atmid."' and live='Y'");
	}else{
		if($bank!=''){
		  $sitesql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		}else{
			$sitesql = mysqli_query($con,"select NewPanelID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
	}

		$atmidarray = [];
		if(mysqli_num_rows($sitesql)>0){
			while($sitesql_result = mysqli_fetch_assoc($sitesql)){
				$atmidarray[] = $sitesql_result['NewPanelID'];
				
			}
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
		
		

	//$panelid = getPanelIDByAtmid($atmid,$con);

	$start_date = $params['start_date'];
	$end_date = $params['end_date'];
	$portal = $params['portal'];


	if($portal=="all"){
	/*$sql = mysqli_query($con,"SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,
		b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE a.NewPanelID=b.panelid AND a.live='Y' AND
		b.panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."' ORDER BY id DESC");	*/
	$sql = "SELECT  a.Customer,a.Bank,a.ATMID,a.ATMShortName,a.SiteAddress,a.DVRIP,a.Panel_make,a.zone as zon,a.City,a.State,b.id,b.panelid,
		b.createtime,b.receivedtime,b.comment,b.zone,b.alarm,b.closedBy,b.closedtime FROM sites a,`alerts` b WHERE a.NewPanelID=b.panelid AND a.live='Y' AND
		b.panelid IN (".$atmidarray.") AND CAST(b.createtime AS DATE)>='".$start_date."' AND CAST(b.createtime AS DATE)<='".$end_date."' ";
	}else{
		if($portal=="active"){
			$sql = mysqli_query($con,"select zone,alarm,panelid,createtime,closedtime,comment,id,closedBy from alerts where panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start."' 
							  AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 
		}else{
			$sql = mysqli_query($con,"select zone,alarm,panelid,createtime,closedtime,comment,id,closedBy from alerts where panelid IN (".$atmidarray.") AND CAST(createtime AS DATE)>='".$start."' 
							  AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 
		}
	}

	
	//$sql = "SELECT * FROM `employee` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($con, $sqlTot) or die("database error:". mysqli_error($con));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($con, $sqlRec) or die($sqlRec);
    $dataArray = array();
	//iterate on results row and create new index array of data
	while( $sql_result = mysqli_fetch_assoc($queryRecords) ) { 
		  $zone = $sql_result['zone'];
		  $alarm = $sql_result['alarm'];
		   $panelid = $sql_result['panelid'];
		   $_site_atmid = $sql_result['ATMShortName'];
		  // $_site_atmid = getsitedetail('ATMShortName',$panelid,$con);
		   $createdatetime = $sql_result['createtime'];
		   $closedatetime = $sql_result['closedtime'];
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
			$duration = $elapsedhr.":".$elapsedmin;
		   }
		   $_newdata = array();
		   /*
		   $_newdata['atmid'] = $sql_result['ATMID'];
		   $_newdata['panelid'] = $panelid;
		   $_newdata['location'] = $_site_atmid;
		   $_newdata['address'] = $sql_result['SiteAddress']; 
		   $_newdata['state'] = $sql_result['State'];
		   $_newdata['city'] = $sql_result['City'];
		   $_newdata['branch_code'] = $_site_atmid;
		   $_newdata['alert_type'] = get_sensor_name($zone,$panelid,$con,$alarm);
			$_newdata['alarm'] = $sql_result['alarm'];
			$_newdata['zone'] = $zone;
			$_newdata['createdatetime'] = $createdatetime;
			$_newdata['closedatetime'] = $closedatetime;
			$_newdata['duration'] = $duration;
			$_newdata['dvrip'] = $sql_result['DVRIP']; 
			$_newdata['comment'] = $sql_result['comment'];
			$_newdata['id'] = $sql_result['id'];
			$_newdata['closedby'] = $sql_result['closedBy']; */
			$_newdata[] = $sql_result['ATMID'];
			$_newdata[] =  get_sensor_name($zone,$panelid,$con,$alarm);
			$_newdata[] = $panelid;
		    $_newdata[] = $_site_atmid;
		    $_newdata[] =  $sql_result['SiteAddress']; 
		    $_newdata[] =  $sql_result['State'];
		    $_newdata[] =  $sql_result['City'];
		    $_newdata[] =  $_site_atmid;
		    $_newdata[] =  $sql_result['alarm'];
			$_newdata[] =  $zone;
			$_newdata[] =  $createdatetime;
			$_newdata[] =  $closedatetime;
			$_newdata[] =  $duration;
			$_newdata[] =  $sql_result['DVRIP']; 
			$_newdata[] =  $sql_result['comment'];
			$_newdata[] =  $sql_result['id'];
			$_newdata[] =  $sql_result['closedBy'];
			array_push($dataArray,$_newdata);
	}	
     CloseCon($con);
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $dataArray   // total data array
			);

	echo json_encode($json_data);  // send data as json format