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
}


$atmidarray = [];
$atmidlist = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
	$atmidlistarr = array();
    if(mysqli_num_rows($atmidlist)>0){
		while($atmid_data=mysqli_fetch_assoc($atmidlist)){
			 $clientatmid = $atmid_data['ATMID']; 
			 array_push($atmidlistarr,$clientatmid);
		}
    }
	$_bank_name = array();
	//$html = "<option value=''>Select</option>";
	
	$path = 'E:\FTP_DATA\HIKVISION\share';

    $files = scandir($path);
    
	$todaydate = date('Y-m-d');
	$_todaydate = str_replace('-','_',$todaydate);
	$yesterdaydate = date('Y-m-d',strtotime("-1 days"));
	$_yesterdaydate = str_replace('-','_',$yesterdaydate);
	
	$atm_present_array = array();
    foreach ($files as $key => $value) {
        $allinfo = explode('_', $value);
        $atm = $allinfo[0];
        if(strlen($atm)>5){
				for($p=0;$p<count($atmidlistarr);$p++){
					if($atm==$atmidlistarr[$p]){
				       $atm_present_array[] = $atm;
					}
				}
        }
    }  
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
	