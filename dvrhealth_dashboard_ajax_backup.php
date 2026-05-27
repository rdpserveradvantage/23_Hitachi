<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); ?>
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
		
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$con = OpenCon();

if($atmid!=''){
	$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and live='Y'");
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$dvr_online_count = 0;
$dvr_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		$camera4_not = 0;
		$dvratmid = $sql_result['atmid'];
		$persitesql = mysqli_query($con,"select Customer,Bank from sites where ATMID='".$dvratmid."'");
		if(mysqli_num_rows($persitesql)>0){
			$checksql_result = mysqli_fetch_assoc($persitesql);
		    $_customer = $checksql_result['Customer'];
		    $_bank = $checksql_result['Bank'];
			if($_customer=='Hitachi' && $_bank=='BOI'){
				$camera4_not = 1;
			}
		}
	/*	if($sql_result['login_status']=='0'){
			if($sql_result['status']=='1'){
			   $dvr_online_count = $dvr_online_count + 1;
			}else{
				$dvr_offline_count = $dvr_offline_count + 1;
			}
		}else{
			$dvr_offline_count = $dvr_offline_count + 1;
		}  */
		
		if($sql_result['login_status']=='0'){
			$dvr_online_count = $dvr_online_count + 1;
		}
		if($sql_result['login_status']=='1'){
			$dvr_offline_count = $dvr_offline_count + 1;
		} 
		
		if($sql_result['login_status']=='0'){
			if(strtoupper($sql_result['cam1'])=='WORKING'){
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			if(strtoupper($sql_result['cam2'])=='WORKING'){
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			if(strtoupper($sql_result['cam3'])=='WORKING'){
				$camera_working_count = $camera_working_count + 1;
			}else{
				$camera_notworking_count = $camera_notworking_count + 1;
			}
			
			
			if($camera4_not == 0){
				if(strtoupper($sql_result['cam4'])=='WORKING'){
					$camera_working_count = $camera_working_count + 1;
				}else{
					$camera_notworking_count = $camera_notworking_count + 1;
				}
			}
		}
		
		/*if(strtoupper($sql_result['hdd'])=='OK'){ }else{
			$hdd_fail_count = $hdd_fail_count + 1;
		} */
		
		if($sql_result['status']==1){ 
		   if($sql_result['login_status']==1){ 
		      $hdd_fail_count = $hdd_fail_count + 1;
		   }
		}
	}
}

$totaldvr = $dvr_online_count + $dvr_offline_count;
$total_online_percent = 0;
$total_offline_percent = 0;
if($totaldvr>0){
$dvr_online_percent = ($dvr_online_count/$totaldvr)*100;
$total_online_percent = number_format((float)$dvr_online_percent, 2, '.', '');

$dvr_offline_percent = ($dvr_offline_count/$totaldvr)*100;
$total_offline_percent = number_format((float)$dvr_offline_percent, 2, '.', '');
}


$array = array(['dvr_online_count'=>$dvr_online_count,'dvr_offline_count'=>$dvr_offline_count,
                 'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,
				 'hdd_fail_count'=>$hdd_fail_count,'total_online_percent'=>$total_online_percent,'total_offline_percent'=>$total_offline_percent]);
CloseCon($con);
echo json_encode($array);
?>


