<?php include('db_connection.php'); ?>
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
    $atmid = "";$circle="";
	if(isset($_POST['bank'])){
	  $bank = $_POST['bank'];
	}
	if(isset($_POST['atmid'])){
	  $atmid = $_POST['atmid'];
	}
	if(isset($_POST['circle'])){
	  $circle = $_POST['circle'];
	}

    $login_status = $_POST['login_status'];

if($atmid!=''){
$sql = mysqli_query($con,"select * from dvr_health where atmid='".$atmid."' and login_status='".$login_status."'"); 
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
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$offlinetestsql = "SELECT * FROM dvr_health WHERE atmid IN (".$atmidarray.") and login_status='".$login_status."'";
    $sql = mysqli_query($con,$offlinetestsql);
}

?>

					    <?php $res_data = [];
                        $count = 0 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
  								  $count = $count + 1;
							       $hddstatus = 'InActive';
								   $hddclass = 'badge badge-pill badge-danger';
                                 if($sql_result['status']==1){
									 $hddstatus = 'Active';
									 $hddclass = 'badge badge-pill badge-success';
								 }
								 $site_atmid = $sql_result['atmid'];
								 $sitesqlres = mysqli_query($con,"select SiteAddress from sites where ATMID='".$site_atmid."' and live='Y'"); 
								 $site_sql_result = mysqli_fetch_assoc($sitesqlres);
								 $siteaddress = $site_sql_result['SiteAddress'];
								 
								 $panelsql = mysqli_query($con,"select status,date from panel_health where atmid='".$site_atmid."'"); 
								 $panel_status = '-';$panel_comm_date = '-';
								 if(mysqli_num_rows($panelsql)>0){
								 $panel_sql_result = mysqli_fetch_assoc($panelsql);
								 $panel_status = $panel_sql_result['status'];
								 $panel_comm_date = $panel_sql_result['date'];
								 }
								 $panelstatus = '-';$panelclass='';
								 if($panel_status==0){
									 $panelstatus = 'Online';
									 $panelclass = 'badge badge-pill badge-success';
								 }
								 if($panel_status==1){
									 $panelstatus = 'Offline';
									 $panelclass = 'badge badge-pill badge-danger';
								 }
								$_data = [];	
								$_data['panel_status'] = $panelstatus; 
								$_data['atmid'] = $site_atmid;
								$_data['ip'] = $sql_result['ip'];
								$_data['last_communication'] = $sql_result['last_communication'];
								$_data['panel_comm_date'] = $panel_comm_date;
								$_data['hdd_status'] = $hddstatus; 
								array_push($res_data,$_data);
							  ?>
							   
								
						<?php }
						  }
						?>
                      

<?php

if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201]);
}


CloseCon($con);
echo json_encode($array);
?>

