<?php include('db_connection.php'); 
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
  
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
$circle = $_POST['circle'];
    $circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
	$circleatmidarray = [];
	while($circlesql_result = mysqli_fetch_assoc($circlesql)){
		$circleatmidarray[] = $circlesql_result['ATMID'];
		
	}
	$circleatmidarray=json_encode($circleatmidarray);
	$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
	$circlearr=explode(',',$circleatmidarray);
	$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
	$sql_query = "select ATMID,SN,SiteAddress,DVRIP,PanelIP,RouterIp from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";
}


$atmidarray = [];
$atmidlist = mysqli_query($con,$sql_query);
	$atmidlistarr = array();
    if(mysqli_num_rows($atmidlist)>0){
		while($atmid_data=mysqli_fetch_assoc($atmidlist)){
			 $clientatmid = $atmid_data['ATMID']; 
			 array_push($atmidlistarr,$clientatmid);
		}
    }
	$_bank_name = array();
	//$html = "<option value=''>Select</option>";
	
//	$path = 'E:\FTP_DATA\HIKVISION\share';

  //  $files = scandir($path);
    
	$todaydate = date('Y-m-d');
	$_todaydate = str_replace('-','_',$todaydate);
	$yesterdaydate = date('Y-m-d',strtotime("-1 days"));
	$_yesterdaydate = str_replace('-','_',$yesterdaydate);
	
	
	//$ftp_conn = OpenFTPCon();
	//$ftp_conn = OpenComfortFTPCon();
	//$ftp_pasv = ftp_pasv($ftp_conn,true);

	//$ftp_conn_1 = OpenComfortFTPCon();
	$ftp_conn_1 = OpenFTPCon();
	$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
	 
	$file_list = ftp_nlist($ftp_conn_1, ".");
	
	$today_date = date('Y-m-d');
	$atm_present_array = array();
	
	for($i=0;$i<count($file_list);$i++){
		if($file_list[$i]=='./AI_Feed'){
		    $file_list_share = ftp_nlist($ftp_conn_1, "./AI_Feed");
			
		    for($j=0;$j<count($file_list_share);$j++){
				$atm = explode('/',$file_list_share[$j]); 
				for($p=0;$p<count($atmidlistarr);$p++){
				   if($atm[2]==$atmidlistarr[$p]){
					   $atm_present_array[]=$atm[2];
					}
				}
		    }	  
		}
	}
	
	/*
	for($i=0;$i<count($file_list);$i++){
		if($file_list[$i]=='AI_Feed'){
		    $file_list_share = ftp_nlist($ftp_conn_1, "AI_Feed");
		    for($j=0;$j<count($file_list_share);$j++){
				$atm = $file_list_share[$j]; 
				for($p=0;$p<count($atmidlistarr);$p++){
				   if($atm==$atmidlistarr[$p]){
					   $atm_present_array[]=$atm;
					}
				}
		    }	  
		}
	} */
    
    
	//return json_encode($atm_present_array);
	 /*if(count($atm_present_array)>0){
		for($i=0;$i<count($atm_present_array);$i++){
			 $todaytotalcount = totalvideocount($atm_present_array[$i],$_todaydate);
					
			  if($todaytotalcount>0){
				  $actualtotalcount = $todaytotalcount;
			  }else{
				  $yesterdaytotalcount = totalvideocount($atm_present_array[$i],$_yesterdaydate);
				  if($yesterdaytotalcount>0){
					$actualtotalcount = $yesterdaytotalcount;  
				  }else{
					$actualtotalcount = 0;  
				  }
			  }  

              if($actualtotalcount>0){
				       $newhtml = '<option value="'.$atm_present_array[$i].'">'.$atm_present_array[$i].'</option>';
					   $html .= $newhtml;
			  }		

			  
		}
	}  */
	CloseCon($con);
	$array = array(['Code'=>200,'res_data'=>$atm_present_array]);
	echo json_encode($array);
	