<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); $con = OpenCon();?>
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


if($atmid!=''){
	$sql = mysqli_query($con,"select * from panel_health where atmid='".$atmid."'");
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
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		        $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			}  
	  
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	//$atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$_is_atmid = $sitesql_result['ATMID'];
			if(count($_circle_name_array)==0){
				$atmidarray[] = $_is_atmid;
			}else{
				if(in_array($_is_atmid,$_circle_name_array)){
				   $atmidarray[] = $_is_atmid;
				}
			}
			//$atmidarray[] = $sitesql_result['ATMID'];
			//array_push($atmidarray,(string)$atmid);
		}
	}else{
		$atmidarray = [];
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$testsql = "SELECT * FROM panel_health WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$testsql);
}
$panel_online_count = 0;
$panel_offline_count = 0;

$camera_working_count = 0;
$camera_notworking_count = 0;
$hdd_fail_count = 0;
if(mysqli_num_rows($sql)){
	while($sql_result = mysqli_fetch_assoc($sql)){
		if($sql_result['status']==1){ 
		   $panel_offline_count = $panel_offline_count + 1;
		 
		}else{
			$panel_online_count = $panel_online_count + 1;
		}
	}
}

$totalpanel = $panel_online_count + $panel_offline_count;
$total_online_percent = 0;
$total_offline_percent = 0;
if($totalpanel>0){
$panel_online_percent = ($panel_online_count/$totalpanel)*100;
$total_online_percent = number_format((float)$panel_online_percent, 2, '.', '');

$panel_offline_percent = ($panel_offline_count/$totalpanel)*100;
$total_offline_percent = number_format((float)$panel_offline_percent, 2, '.', '');
}

$array = array(['dvr_online_count'=>$panel_online_count,'dvr_offline_count'=>$panel_offline_count,
                 'total_online_percent'=>$total_online_percent,'total_offline_percent'=>$total_offline_percent]);
CloseCon($con);
echo json_encode($array);
?>


