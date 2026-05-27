<?php session_start();include('db_connection.php'); 
    date_default_timezone_set('Asia/Kolkata');
$currtime=date('Y-m-d');
	$con = OpenCon();
	$bank = "";
	$circle = "";
	$client = "";

	$banks = explode(",",$_SESSION['bankname']);
	$_bank_name = [];
	for($i=0;$i<count($banks);$i++){
	   $_bank = explode("_",$banks[$i]);
	   if($_bank[0]==$client){
		   array_push($_bank_name,$_bank[1]);
	   }
	} 
	/*
	if(count($_bank_name)==0){
		$sitesql = mysqli_query($con,"select ATMID,NewPanelID,Panel_Make,DVRName from sites where live='Y' AND DVRName IN ('Hikvision_Nvr','UNV','Dahuva')");
	}else{
		$_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
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
					$sitesql = mysqli_query($con,"select ATMID,NewPanelID,Panel_Make,DVRName from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y' AND DVRName IN ('Hikvision_Nvr','UNV','Dahuva')");	
				}else{ 
					 $sitesql = mysqli_query($con,"select ATMID,NewPanelID,Panel_Make,DVRName from sites where Customer='".$client."' and Bank='".$bank."' and live='Y' AND DVRName IN ('Hikvision_Nvr','UNV','Dahuva')");
				} 
		 
		}else{
			$sitesql = mysqli_query($con,"select ATMID,NewPanelID,Panel_Make,DVRName from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' AND DVRName IN ('Hikvision_Nvr','UNV','Dahuva')");
		}
	}
	*/
	$site_qry = "SELECT s.ATMID,s.NewPanelID,s.Panel_Make,s.DVRName, IF(a.cnt IS NULL, 0, a.cnt) AS alert_count
                 FROM `sites` s LEFT JOIN (select panelid,COUNT(id) AS cnt from alerts WHERE sendtoclient='S' AND CAST(receivedtime AS DATE)='".$currtime."' 
				 GROUP BY panelid) a ON a.panelid = s.NewPanelID WHERE s.live='Y' AND DVRName IN ('Hikvision_Nvr','UNV','Dahuva') ORDER BY alert_count DESC";
    
	$sitesql = mysqli_query($con, $site_qry);
	$code=201;
    $_data = [];
	$atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$atmidarray[] = " ".$sitesql_result['NewPanelID'];
			$_atmid = $sitesql_result['ATMID'];
			$panelid = $sitesql_result['NewPanelID'];
			$_panelname = $sitesql_result['Panel_Make'];
			$_dvrname = $sitesql_result['DVRName'];
			$alert_count = $sitesql_result['alert_count'];
			//$query = "select id from alerts where panelid ='".$panelid."' AND status='O' AND sendtoclient='S' AND CAST(receivedtime AS DATE)='".$currtime."'";
            //$sql = mysqli_query($con,$query);
            //$alert_count = mysqli_num_rows($sql);
			
			$data_arr = [];
			$data_arr['atm_id'] = $_atmid;
			$data_arr['panel_name'] = $_panelname;
			
			$data_arr['dvr_name'] = $_dvrname;
			$data_arr['alert_count'] = $alert_count;
			
			array_push($_data,$data_arr);	
		}
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}
	
    if(count($_data)>0){
		$code=200;
	}
$array = array(['code'=>$code,'res_data'=>$_data]);
CloseCon($con);
echo json_encode($array);
?>
