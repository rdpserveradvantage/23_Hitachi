<?php session_start();include('db_connection.php'); $con = OpenCon();
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
$client = $_GET['client'];
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


   $bank = "";$circle = "";
   $atmid = "";
if(isset($_GET['bank'])){
$bank = $_GET['bank'];
}
if(isset($_GET['circle'])){
$circle = $_GET['circle'];
}
if(isset($_GET['atmid'])){
$atmid = $_GET['atmid'];
}
$start = $_GET['start'];
$end = $_GET['end'];
$portal = $_GET['portal'];


    if($atmid!=''){
		$sitesql = mysqli_query($con,"select ATMID from sites where ATMID='".$atmid."' and live='Y'");
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
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
				}else{ 
					 $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				} 
		 
		}else{
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
	}
	$atmidarray = [];
while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		//$atmidarray[] = $sitesql_result['ATMID'];
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}

if($portal=="all"){
$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"); 
}else{
	if($portal=="active"){
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='O' ORDER BY id DESC"); 
	}else{
		$sql = mysqli_query($con,"select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND status='C' ORDER BY id DESC"); 
	}
}


$code=201;
$_data = [];

	$count = 1 ; 
	  if(mysqli_num_rows($sql)>0){
		  while($sql_result = mysqli_fetch_assoc($sql)){ 
			$_atmid = trim($sql_result['ATMCode']);
			$_dvrip = "-";
			$_siteaddress = "-";
			$sitesql = mysqli_query($con,"select ATMID,DVRIP,SiteAddress from sites where ATMID='".$_atmid."'");
			if(mysqli_num_rows($sitesql)>0){
			  $sitesql_result = mysqli_fetch_assoc($sitesql);
			  $_siteaddress = $sitesql_result['SiteAddress'];
			  $_dvrip = $sitesql_result['DVRIP'];
			}
			$_status = 'Closed';
			if($sql_result['status']=='O'){
				$_status = 'Active';
			}
			
			$data_arr = [];
			$data_arr['ticket_id'] = $sql_result['id'];
			$data_arr['site_address'] = $_siteaddress;
			$data_arr['atm_id'] = $_atmid;
			$data_arr['alert_type'] = $sql_result['alerttype'];
			$data_arr['createdatetime'] = $sql_result['createtime'];
			
			$data_arr['dvr_ip'] = $_dvrip;
			$data_arr['alarm_status'] = $_status ;
			
			array_push($_data,$data_arr);	
		  }
	  }
	  if(count($_data)>0){
		  $code=200;
	  }
$array = array(['code'=>$code,'res_data'=>$_data]);
CloseCon($con);
echo json_encode(utf8ize($array));
?>
