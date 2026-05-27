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

   $bank = "";
   $atmid = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
$con = OpenComsarmiCon();

$dvronline_count = 0;
$dvroffline_count = 0;
if($atmid!=''){
	$dvrsql = mysqli_query($con,"select status from clouddvr_health where atmid='".$atmid."' and live='Y'"); 
	if(mysqli_num_rows($dvrsql)>0){
		$dvr_res = mysqli_fetch_assoc($dvrsql);
		if($dvr_res['status']=='1'){
			$dvronline_count = $dvronline_count + 1;
		}
		if($dvr_res['status']=='0'){
			$dvroffline_count = $dvroffline_count + 1;
		}
	}
	
	
}else{
	if($bank!=''){
	  $sitesql = mysqli_query($con,"select ATMID from dvronline where customer='".$client."' and Bank='".$bank."' and Status='Y'");
	}else{
		$sitesql = mysqli_query($con,"select ATMID from dvronline where customer='".$client."' and Bank IN (".$_bank_name.") and Status='Y'");
	}
	//$atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	}else{
		$atmidarray = [];
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	/*
	$onlinetestsql = "SELECT id FROM clouddvr_health WHERE atmid IN (".$atmidarray.") and status='1'";
    $onlinesql = mysqli_query($con,$onlinetestsql);
	
	$offlinetestsql = "SELECT id FROM clouddvr_health WHERE atmid IN (".$atmidarray.") and status='0'";
    $offlinesql = mysqli_query($con,$offlinetestsql); */
	
		
	$dvrsql = mysqli_query($con,"select status from clouddvr_health where atmid IN (".$atmidarray.")"); 
	if(mysqli_num_rows($dvrsql)>0){
		while($dvr_res = mysqli_fetch_assoc($dvrsql)){
			if($dvr_res['status']=='1'){
				$dvronline_count = $dvronline_count + 1;
			}
			if($dvr_res['status']=='0'){
				$dvroffline_count = $dvroffline_count + 1;
			}
		}
	}
	
	
}


CloseCon($con);

echo $dvronline_count."_".$dvroffline_count;
?>


