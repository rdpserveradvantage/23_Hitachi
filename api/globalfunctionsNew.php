<?php 
function getDVROnlineClients($userid){
    global $con;
	$usersql = mysqli_query($con,"select cust_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_client_ids = $userdata['cust_id'];
    $banks = explode(",",$_client_ids);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		  // $_bank = explode("_",$banks[$i]);
		   $_bank = $banks[$i];
		  // if($_bank[0]==$client){
			   array_push($_bank_name,$_bank);
		 //  }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
	$sql = mysqli_query($con,"select customer from dvronline where customer IN (".$_bank_name.") and Status='Y' group by customer");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['customer']; 
		array_push($html,$value);
	}
	return $html;
}
function getClients($userid){
    global $con;
	$usersql = mysqli_query($con,"select cust_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_client_ids = $userdata['cust_id'];
    $banks = explode(",",$_client_ids);
       $_bank_name = [];
       for($i=0;$i<count($banks);$i++){
		  // $_bank = explode("_",$banks[$i]);
		   $_bank = $banks[$i];
		  // if($_bank[0]==$client){
			   array_push($_bank_name,$_bank);
		 //  }
	   } 
	    $_bank_name=json_encode($_bank_name);
		$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
		$bankarr=explode(',',$_bank_name);
		$_bank_name = "'" . implode ( "', '", $bankarr )."'";
		
	$sql = mysqli_query($con,"select Customer from sites where Customer IN (".$_bank_name.") and live='Y' group by Customer");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Customer']; 
		array_push($html,$value);
	}
	return $html;
}

function getBanks(){
    global $con;

	$sql = mysqli_query($con,"select Bank from sites where live='Y' group by Bank");
	
	$html = "<option value=''>Select</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}

function getBanksByClientID($client,$userid){
    global $con;
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
    
	$sql = mysqli_query($con,"select Bank from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y' group by Bank");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		$cust_bank = $client."_".$value;
		if(in_array($cust_bank,$banks)){
		array_push($html,$value);
		}
		
	}
	return $html;
}


function getDVROnlineBanksByClientID($client,$userid){
    global $con;
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
    
	$sql = mysqli_query($con,"select Bank from dvronline where customer='".$client."' and Bank IN (".$_bank_name.") and Status='Y'");
	
	$html = [];
	$_checkbank = array();
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		if(!in_array($value,$_checkbank)){
			$_checkbank[] = $value; 
			$cust_bank = $client."_".$value;
			if(in_array($cust_bank,$banks)){
			array_push($html,$value);
			}
		}
	}
	return $html;
}

function getAtmids($bank){
    global $con;

	$sql = mysqli_query($con,"select ATMID from sites where live='Y' and Bank='".$bank."'");
	
	$html = "<option value=''>Select</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}

function getAtmidList($client,$bank){
    global $con;

	$sql = mysqli_query($con,"select ATMID from sites where live='Y' and Customer = '".$client."' and Bank='".$bank."'");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value['label'] = $sql_result['ATMID'];
		$value['value'] = $sql_result['ATMID'];
		array_push($html,$value);
	}
	return $html;
}

function getDVROnlineAtmidList($client,$bank){
    global $con;

	$sql = mysqli_query($con,"select ATMID from dvronline where Status='Y' and customer = '".$client."' and bank='".$bank."'");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		array_push($html,$value);
	}
	return $html;
}

function getCities($state_code)
{
	global $con;
	$sql=mysqli_query($con,"select * from all_cities where state_code = '" .trim($state_code)."'");
	// $state_name=mysqli_query($con,"select city_name from all_cities where ");
	$html='<option value="">Select</option>';
	while($sql_result = mysqli_fetch_assoc($sql))
	{
		$value = $sql_result['city_name']; 
		$city_code = $sql_result['city_code']; 

		$html .= '<option value="'.$city_code.'">'.$value.'</option>';
	}
	return json_encode($html);
}

function CityName($citycode)
{
	global $con;
	$sql=mysqli_query($con,"select * from all_cities where city_code = '" .trim($citycode)."'");
	
	$sql_result = mysqli_fetch_assoc($sql);
	
		return $sql_result['city_name']; 
}

function StateName($statecode)
{
	global $con;
	$sql=mysqli_query($con,"select * from all_states where state_code = '" .trim($statecode)."'");
	
	$sql_result = mysqli_fetch_assoc($sql);
	
		return $sql_result['state_name']; 
}
function getallalerttype($atmid){
	global $con;
    
	$sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
    $panelmake = $sql_result['Panel_Make'];
	
	if($panelmake=='RASS'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass`");
	}
	if($panelmake=='rass_cloud'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass_cloud`");
	}
	if($panelmake=='SMART-IN'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `smarti`");
	} 		
	if($panelmake=='rass_cloudnew'){
		$rass_sql = mysqli_query($con,"SELECT SensorName FROM `rass_cloudnew`");
	} 	
	
	$html = "";
	while($sql_result = mysqli_fetch_assoc($rass_sql)){
		$value = $sql_result['SensorName']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
	//$sensor_sql_result = mysqli_fetch_assoc($rass_sql);
	//return json_encode($sensor_sql_result);
}
function getCirclesByBank($bankcircle){
    global $con;
    //$banks = explode(",",$_SESSION['bankname']);
	$sql = mysqli_query($con,"select Circle from site_circle where Bank='".$bankcircle."' group by Circle");
	
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value['label'] = $sql_result['Circle'];
		$value['value'] = $sql_result['Circle'];
		array_push($html,$value);
	}
	return $html;
	
	
}
function getAtmidCircleList($bank,$circle){
    global $con;

	$sql = mysqli_query($con,"select ATMID from site_circle where Bank='".$bank."' AND Circle='".$circle."'");
	$html = [];
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value['label'] = $sql_result['ATMID'];
		$value['value'] = $sql_result['ATMID'];
		array_push($html,$value);
	}
	
	return $html;
}