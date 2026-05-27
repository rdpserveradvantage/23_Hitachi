<?php session_start();include('db_connection.php'); 
$client = $_POST['client'];
$bank = $_POST['bank'];
$circle = $_POST['circle'];
$atmid = $_POST['atmid'];
$month = $_POST['month'];
$year = $_POST['year'];
$site_monitoring_charges = "3400";
$con = OpenCon();

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

    if($atmid!=''){
		$sitesql = mysqli_query($con,"select SN from sites where ATMID='".$atmid."' and live='Y'");
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
					$sitesql = mysqli_query($con,"select SN from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
				}else{ 
					 $sitesql = mysqli_query($con,"select SN from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				} 
		 
		}else{
			$sitesql = mysqli_query($con,"select SN from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
	}
	$atmidarray = [];
while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = " ".$sitesql_result['SN'];
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}
	$query = "select * from dvr_health_site_monthwise_new where SN IN (".$atmidarray.") and month='".$month."' and year='".$year."'";
//echo $query;
$sql = mysqli_query($con,$query);

$code=201;
$_data = [];
$month_array = array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
	$count = 1 ; 
	  if(mysqli_num_rows($sql)>0){
		  while($sql_result = mysqli_fetch_assoc($sql)){ 
			$id = $sql_result['id'];
			$SN = $sql_result['SN'];
			$_month = $sql_result['month'];
			$_year = $sql_result['year'];
			$total_down_time = $sql_result['total_down_time'];
			$_atmid = "";
			$_dvrip = "-";
			$_siteaddress = "-";
			$site_sql = mysqli_query($con,"select ATMID,DVRIP,SiteAddress from sites where SN='".$SN."'");
			if(mysqli_num_rows($site_sql)>0){
			  $_sitesql_result = mysqli_fetch_assoc($site_sql);
			  $_siteaddress = $_sitesql_result['SiteAddress'];
			  $_dvrip = $_sitesql_result['DVRIP'];
			  $_atmid = $_sitesql_result['ATMID'];
			}
			$_month_value = $month_array[$_month];
			$data_arr = [];
			$data_arr['id'] = $sql_result['id'];
			$data_arr['site_address'] = htmlspecialchars($_siteaddress);
			$data_arr['atm_id'] = $_atmid;
			$data_arr['month'] = $_month_value;
			$data_arr['year'] = $_year;
			$src = "";
			$data_arr['dvr_ip'] = $_dvrip;
			$data_arr['total_down_time'] = $total_down_time ;
			$penalty_amt = 0;
			$penaltysql = mysqli_query($con,"select penalty_percentage from esurveillance_penalty_master where minimum_hour<'".$total_down_time."' AND maximum_hour>='".$total_down_time."'");
			if(mysqli_num_rows($penaltysql)>0){
				$penaltysql_result = mysqli_fetch_assoc($penaltysql);
				$percentage = $penaltysql_result['penalty_percentage'];
				$penalty_amt = ($site_monitoring_charges * $percentage)/100;
			}
			$data_arr['penalty_amt'] = $penalty_amt;
			if($penalty_amt>0){ 
			  $src = $sql_result['id'];
			}
			$data_arr['src'] = $src;
			array_push($_data,$data_arr);	
		  }
	  }
	  if(count($_data)>0){
		  $code=200;
	  }
$array = array(['code'=>$code,'res_data'=>$_data]);
CloseCon($con);
echo json_encode($array);
?>
