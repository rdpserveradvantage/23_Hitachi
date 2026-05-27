<?php 
function getDVROnlineClients(){
    global $con;

	$sql = mysqli_query($con,"select customer from dvronline where Status='Y' group by customer");
	
	$html = "";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['customer']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}
function getClients(){
    global $con;

	$sql = mysqli_query($con,"select Customer from sites where live='Y' group by Customer");
	
	$html = "";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Customer']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}

function get_Clients(){
    global $con;

	$sql = mysqli_query($con,"select Customer from sites where live='Y' group by Customer");
	
	$html = "";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Customer']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
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

function getBanksByClientID($client){
    global $con;
    $banks = explode(",",$_SESSION['bankname']);
	$sql = mysqli_query($con,"select Bank from sites where live='Y' and Customer='".$client."' group by Bank");
	
	$html = "<option value=''>Select</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		$cust_bank = $client."_".$value;
		$newhtml = "";
		if(in_array($cust_bank,$banks)){
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		}
		$html .= $newhtml;
	}
	return $html;
}
function getBankAtmidList($client,$bank){
	global $con;

	$sql = mysqli_query($con,"select ATMID from sites where live='Y' and Customer='".$client."' and Bank='".$bank."'");
	
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}
function getAtmids($bank){
    global $con;

	$sql = mysqli_query($con,"select ATMID from sites where live='Y' and Bank='".$bank."'");
	
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}

function getAtmidList($client,$bank){
    global $con;
	$zonal = "";$circle = "";
    $_zonal_name = "";$_circle_name="";
    if($_SESSION['zonalname']!=''){
    $zonal = explode(",",$_SESSION['zonalname']);
	}
	if($_SESSION['circlename']!=''){
	$circle = explode(",",$_SESSION['circlename']);
	}
	if($zonal!=''){
       $_zonal_name = [];
        for($i=0;$i<count($zonal);$i++){
		   array_push($_zonal_name,$zonal[$i]);
		} 
	    $_zonal_name=json_encode($_zonal_name);
		$_zonal_name=str_replace( array('[',']','"') , ''  , $_zonal_name);
		$zonalarr=explode(',',$_zonal_name);
		$_zonal_name = "'" . implode ( "', '", $zonalarr )."'";
		
	    $_circle_name = [];
        for($i=0;$i<count($circle);$i++){
		   $_circle = explode("_",$circle[$i]);
		   array_push($_circle_name,$_circle[1]);
		} 
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";	
	}
	$circle_count = 0;
	if($bank=='PNB'){
		if($_zonal_name!=""){	
			echo "select ATMID from site_circle where Bank='".$bank."' AND Zonal IN (".$_zonal_name .") AND Circle IN (".$_circle_name.") group by ATMID";
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Bank='".$bank."' AND Zonal IN (".$_zonal_name .") AND Circle IN (".$_circle_name.") group by ATMID");
		}else{
			echo "select ATMID from site_circle where Bank='".$bank."' group by ATMID" ; 
			$circlesql = mysqli_query($con,"select ATMID from site_circle where Bank='".$bank."' group by ATMID");
		}
	}
	$circleatm_arr = array();
	$circle_count= mysqli_num_rows($circlesql);
	if($circle_count==0){
		
	}else{
		while($circlesql_result = mysqli_fetch_assoc($circlesql)){
			$circle_value = $circlesql_result['ATMID']; 
			array_push($circleatm_arr,$circle_value);
		}	
	}
	
	$sql = mysqli_query($con,"select ATMID from sites where live='Y' and Customer = '".$client."' and Bank='".$bank."'");
	
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		if($circle_count==0){
			if($value!=''){
			$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			$html .= $newhtml;
			}
		}else{
			if (in_array($value, $circleatm_arr)){
				$newhtml = '<option value="'.$value.'">'.$value.'</option>';
				$html .= $newhtml;
			}
		}
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
    
	$sql_site = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql_site);
    $panel_name = $sql_result['Panel_Make'];
	$paramater = 'SensorName';
	//$sql = "123A";
		if($panel_name=='comfort'){
			$sql = mysqli_query($con,"select $paramater from comfort");
		}
		if($panel_name=='rass_boi'){
			$sql = mysqli_query($con,"select $paramater from rass_boi");
		}
		if($panel_name=='rass_pnb'){
			$sql = mysqli_query($con,"select $paramater from rass_pnb");
		}
		if($panel_name=='smarti_boi'){
			$sql = mysqli_query($con,"select $paramater from smarti_boi");
		}
		if($panel_name=='smarti_pnb'){
			$sql = mysqli_query($con,"select $paramater from smarti_pnb");
		}
		if($panel_name=='RASS'){
			$sql = mysqli_query($con,"select $paramater from rass where status=0");
		}
		if($panel_name=='rass_cloud'){
			$sql = mysqli_query($con,"select $paramater from rass_cloud where status=0");
		}
		if($panel_name=='rass_cloudnew'){
			$sql = mysqli_query($con,"select $paramater from rass_cloudnew where status=0");
		}
		if($panel_name=='rass_sbi'){
			$sql = mysqli_query($con,"select $paramater from rass_sbi where status=0");
		}
		
		if($panel_name=='SEC'){
			$sql = mysqli_query($con,"select $paramater from securico where status=0");
		}
		if($panel_name=='securico_gx4816'){
			$sql = mysqli_query($con,"select $paramater from securico_gx4816 where status=0");
		}
		if($panel_name=='sec_sbi'){
			$sql = mysqli_query($con,"select $paramater from sec_sbi where status=0");
		}
		if($panel_name=='Raxx'){
			$sql = mysqli_query($con,"select $paramater from raxx where status=0");
		}
		if($panel_name=='SMART -I'){
			$sql = mysqli_query($con,"select $paramater from smarti where status=0");
		}
		if($panel_name=='SMART-IN'){
			$sql = mysqli_query($con,"select $paramater from smartinew where status=0");
		}
		if($panel_name=='RASSN'){
			$sql = mysqli_query($con,"select $paramater from rass_sbi where status=0");
		}
		
		if($atmid=='NA160300'){
			$sql = mysqli_query($con,"select $paramater from rass_sbi where status=0");
		}
	
	$html = "";
	//return $sql;
	if(mysqli_num_rows($sql)>0){
		while($sql_result = mysqli_fetch_assoc($sql)){
			$value = $sql_result['SensorName']; 
			$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			$html .= $newhtml;
		}
	}
	return $html; 
	//$sensor_sql_result = mysqli_fetch_assoc($rass_sql);
	//return json_encode($sensor_sql_result);
}

function getDvrOnlineAtmids($bank){
    global $con;

	$sql = mysqli_query($con,"select ATMID from dvronline where Status='Y' and Bank='".$bank."'");
	
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}
	return $html;
}

function getDvrOnlineBanksByClientID($client){
    global $con;
    $banks = explode(",",$_SESSION['bankname']);
	$sql = mysqli_query($con,"select Bank from dvronline where customer='".$client."' and Status='Y' group by Bank");
	$_bank_name = array();
	$html = "<option value=''>Select</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		if(in_array($value,$_bank_name)){
			
		}else{
			/*
			if($value=='Axis WLA'){
				$value = str_replace(" ","-",$value);
			}else{
			$_bank_name[] = $value;
			}
			*/
			$_bank_name[] = $value;
			$cust_bank = $client."_".$value;
			$newhtml = "";
			if(in_array($cust_bank,$banks)){
			$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			} 
			//$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			$html .= $newhtml;
		}
	}
	//return json_encode($banks);
	return $html;
}

function total_videocount($atmid,$dt){
	$filecount = 0;
	$dir = "E:\\FTP_DATA\\HIKVISION\\share\\$atmid\\$dt";
	$myDirectory=opendir("E:\\FTP_DATA\\HIKVISION\\share\\$atmid\\$dt");
                                     // Gets each entry
	while(false !== ($entryName=readdir($myDirectory))) {
		  $dirArray[]=$entryName;
	}
	natcasesort($dirArray);
	foreach ($dirArray as $file) {
		if($file!="." && $file!=".."){
			if($file!="DVRWorkDirectory" ){
				$_filecount = 0;
				$fi = new FilesystemIterator("E:\\FTP_DATA\\HIKVISION\\share\\$atmid\\$dt\\$file", FilesystemIterator::SKIP_DOTS);
				$_filecount = iterator_count($fi);
				$filecount = $filecount + $_filecount;
			}
		}
	} 
    return $filecount;
  // return $dir; 
}

function OpenFTPCon()
 {
	$ftp_server = "192.168.100.26"; 
	$ftp_username = "comfort_cloud";
	$ftp_userpass = "cam@12345";
	$ftp_port = "7553";
	$timeout = "90";
	$ftp_conn = ftp_connect($ftp_server,$ftp_port,$timeout) or die("Could not connect to $ftp_server");
	$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

	// check connection
	if ((!$ftp_conn) || (!$login)) {
		  echo "FTP connection has failed!";
		  echo "Attempted to connect to $ftp_server for user $ftp_username";
		  die;
	  } else {
		 // echo "Connected to $ftp_server, for user $ftp_username";
	  }
	 
	 return $ftp_conn;
 }
 
function getVideoAtmidList($client,$bank){
    global $con;
	//global $ftp_conn_1;
	
	$zonal = "";$circle=[];
	$_circle_name = "";$_zonal_name="";
	if($_SESSION['zonalname']!=''){
    $zonal = explode(",",$_SESSION['zonalname']);
	}
	if($_SESSION['circlename']!=''){
	$circle = explode(",",$_SESSION['circlename']);
	}
	if($zonal!=''){
       $_zonal_name = [];
        for($i=0;$i<count($zonal);$i++){
		   array_push($_zonal_name,$zonal[$i]);
		} 
	    $_zonal_name=json_encode($_zonal_name);
		$_zonal_name=str_replace( array('[',']','"') , ''  , $_zonal_name);
		$zonalarr=explode(',',$_zonal_name);
		$_zonal_name = "'" . implode ( "', '", $zonalarr )."'";
		
	    $_circle_name = [];
		if(count($circle)==0){
			
		}else{
			for($i=0;$i<count($circle);$i++){
			   $_circle = explode("_",$circle[$i]);
			   array_push($_circle_name,$_circle[1]);
			} 
			$_circle_name=json_encode($_circle_name);
			$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
			$circlearr=explode(',',$_circle_name);
			$_circle_name = "'" . implode ( "', '", $circlearr )."'";	
		}
	}	
    if($_zonal_name!=""){
		if($bank=='PNB'){
			$qry = "select ATMID from sites where Customer='".$client."' and Bank='".$bank."' AND ATMID IN (select ATMID from site_circle where Bank='".$bank."' AND Circle IN (".$_circle_name.")) and live='Y'";
	    }else{
			$qry = "select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'";
		}
		    
	    $atmidlist = mysqli_query($con,$qry);
	}else{
		$qry = "select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'";
		$atmidlist = mysqli_query($con,$qry);
	}
	 $atmidlistarr = array();
		  if(mysqli_num_rows($atmidlist)>0){
			  while($atmid_data=mysqli_fetch_assoc($atmidlist)){
				 $clientatmid = $atmid_data['ATMID']; 
				 array_push($atmidlistarr,$clientatmid);
			  }
		  }
	$_bank_name = array();
	
	
	//$path = 'E:\FTP_DATA\HIKVISION\share';

    //$files = scandir($path);
	
	//$checkimage_dir = $path .'/'.$atm.'/'.$custdate;
   // $checkfiles = ftp_nlist($ftp_conn_local, $checkimage_dir);
	//$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
	
    $ftp_conn_1 = OpenFTPCon();
	$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
    $file_list = ftp_nlist($ftp_conn_1, ".");
    
	$todaydate = date('Y-m-d');
	$_todaydate = str_replace('-','_',$todaydate);
	$yesterdaydate = date('Y-m-d',strtotime("-1 days"));
	$_yesterdaydate = str_replace('-','_',$yesterdaydate);
	
	$atm_present_array = array();
	$f = $file_list[0]; $ip ="in";
	for($i=0;$i<count($file_list);$i++){
		$string = $file_list[$i];
		$string = str_replace(' ', '', $string);
		if($string=='./AI_Feed'){ 
			$file_list_share = ftp_nlist($ftp_conn_1, "./AI_Feed");
			for($j=0;$j<count($file_list_share);$j++){
				$atm = $file_list_share[$j]; 
				for($p=0;$p<count($atmidlistarr);$p++){
					$atmstring = $atm;
					$atmstring = str_replace('./AI_Feed/', '', $atmstring);
					if($atmidlistarr[$p]=='ZBB8044'){
						$ip = $atmstring;
					}
					if($atmstring!='desktop.ini'){	
						if($atmstring==$atmidlistarr[$p]){
							$atm_present_array[]=$atmidlistarr[$p];
						}
					}
				}
			}	  
		}
	}
	/*
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
    }   */
	//return json_encode($atm_present_array);
	/*
	if(count($atm_present_array)>0){
		for($i=0;$i<count($atm_present_array);$i++){
			$todaytotalcount = 1;
			  if($todaytotalcount>0){
				  $actualtotalcount = $todaytotalcount;
			  }else{
				  $yesterdaytotalcount = totalvideocount($atm_present_array[$i],$_yesterdaydate,$ftp_conn_1);
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
	}*/
	$html = "<option value=''>All Site</option>";
	if(count($atm_present_array)>0){
		for($i=0;$i<count($atm_present_array);$i++){
			$newhtml = '<option value="'.$atm_present_array[$i].'">'.$atm_present_array[$i].'</option>';
		    $html .= $newhtml;
		}
	}
	
	/*
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		if(in_array($value,$_bank_name)){
			
		}else{
			$_bank_name[] = $value;
			$cust_bank = $client."_".$value;
			$newhtml = "";
			if(in_array($cust_bank,$banks)){
			$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			} 
			
			$html .= $newhtml;
		}
	} */
	return $html;
	//return json_encode($file_list_share);
	//return count($atm_present_array);
}
function totalvideocount($atmid,$custdate,$ftp_conn_1){
	//global $ftp_conn_1;
	//echo count(ftp_nlist($ftp, 'uploads/'));
	$path = './AI_Feed';
	//$path = 'E:\FTP_DATA\HIKVISION\share';
	$checkimage_dir = $path .'/'.$atm.'/'.$custdate;
    $filecount = count(ftp_nlist($ftp_conn_1, $checkimage_dir));
	return $filecount;
}
function getVideoAtmidCircleList($bank,$circle){
    global $con;
	 $atmidlist = mysqli_query($con,"select ATMID from sites where ATMID IN (SELECT ATMID from site_circle where Circle='".$circle."' and Bank='".$bank."') and live='Y'");
	 $atmidlistarr = array();
		  if(mysqli_num_rows($atmidlist)>0){
			  while($atmid_data=mysqli_fetch_assoc($atmidlist)){
				 $clientatmid = $atmid_data['ATMID']; 
				 array_push($atmidlistarr,$clientatmid);
			  }
		  }
	$_bank_name = array();
	$html = "<option value=''>All Site</option>";
	
	//$path = 'E:\FTP_DATA\HIKVISION\share';

    //$files = scandir($path);
	
	$ftp_conn_1 = OpenFTPCon();
	$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
    $file_list = ftp_nlist($ftp_conn_1, ".");
    
	$todaydate = date('Y-m-d');
	$_todaydate = str_replace('-','_',$todaydate);
	$yesterdaydate = date('Y-m-d',strtotime("-1 days"));
	$_yesterdaydate = str_replace('-','_',$yesterdaydate);
	
	$atm_present_array = array();
	
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
	}
    /*
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
    }   */
	//return json_encode($atm_present_array);
	/*
	if(count($atm_present_array)>0){
		for($i=0;$i<count($atm_present_array);$i++){
			 // $todaytotalcount = totalvideocount($atm_present_array[$i],$_todaydate);
					 $todaytotalcount = 1;
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
	}
	*/
	if(count($atm_present_array)>0){
		for($i=0;$i<count($atm_present_array);$i++){
			$newhtml = '<option value="'.$atm_present_array[$i].'">'.$atm_present_array[$i].'</option>';
		    $html .= $newhtml;
		}
	}
	
	
	/*
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		if(in_array($value,$_bank_name)){
			
		}else{
			$_bank_name[] = $value;
			$cust_bank = $client."_".$value;
			$newhtml = "";
			if(in_array($cust_bank,$banks)){
			$newhtml = '<option value="'.$value.'">'.$value.'</option>';
			} 
			
			$html .= $newhtml;
		}
	} */
	return $html;
}
function getCirclesByBank($bankcircle){
    global $con;
	$zonal = "";$circle="";
	$_circle_name = "";$_zonal_name="";
	if($_SESSION['zonalname']!=''){
    $zonal = explode(",",$_SESSION['zonalname']);
	}
	if($_SESSION['circlename']!=''){
	$circle = explode(",",$_SESSION['circlename']);
	}
	if($zonal!=''){
       $_zonal_name = [];
        for($i=0;$i<count($zonal);$i++){
		   array_push($_zonal_name,$zonal[$i]);
		} 
	    $_zonal_name=json_encode($_zonal_name);
		$_zonal_name=str_replace( array('[',']','"') , ''  , $_zonal_name);
		$zonalarr=explode(',',$_zonal_name);
		$_zonal_name = "'" . implode ( "', '", $zonalarr )."'";
		
	    $_circle_name = [];
        for($i=0;$i<count($circle);$i++){
		   $_circle = explode("_",$circle[$i]);
		   array_push($_circle_name,$_circle[1]);
		} 
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";	
	}	
	//$sql = mysqli_query($con,"select Circle from site_circle where Bank='".$bankcircle."' AND Zonal IN (".$_zonal_name .") AND Circle IN (".$_circle_name.") group by Circle");
	if($_zonal_name!=""){
	$sql = mysqli_query($con,"select Circle from site_circle where Bank='".$bankcircle."' AND Zonal IN (".$_zonal_name .") AND Circle IN (".$_circle_name.") group by Circle");
	}else{
	$sql = mysqli_query($con,"select Circle from site_circle where Bank='".$bankcircle."' group by Circle");	
	}
	$html = "<option value=''>All Circle</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Circle']; 
		if($value!=''){
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
		}
	}
	return $html;
}
function getAtmidCircleList($bank,$circle){
    global $con;
	//$sql = mysqli_query($con,"select ATMID from site_circle where Bank='".$bank."' AND Circle='".$circle."'");
	if($circle=='AJMER'){
		$sql = mysqli_query($con,"select ATMID from sites where ATMID IN (select ATMID from site_circle where Bank='".$bank."' AND Circle='".$circle."') AND live='Y' ORDER BY TrackerNo DESC");
	}else{
   	    $sql = mysqli_query($con,"select ATMID from sites where ATMID IN (select ATMID from site_circle where Bank='".$bank."' AND Circle='".$circle."') AND live='Y'");
	}
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		if($value!=''){
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
		}
	}
	$newhtml = '<option value="Hello">Hello/</option>';
	return $html;
}
/*  AI Sites */
function getAIBanksByClientID($client){
    global $con;
    $banks = explode(",",$_SESSION['bankname']);
	$sql = mysqli_query($con,"select Bank from ai_sites where live='Y' and Customer='".$client."' group by Bank");
	
	$html = "<option value=''>Select</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['Bank']; 
		$cust_bank = $client."_".$value;
		$newhtml = "";
		if(in_array($cust_bank,$banks)){
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		}
		$html .= $newhtml;
	}
	return $html;
}
function getAIAtmidList($client,$bank){
    global $con;
    $zonal = "";$circle="";
	$_circle_name = "";$_zonal_name="";
	if($_SESSION['zonalname']!=''){
    $zonal = explode(",",$_SESSION['zonalname']);
	}
	if($_SESSION['circlename']!=''){
	$circle = explode(",",$_SESSION['circlename']);
	}
	if($zonal!=''){
        $_zonal_name = [];
        for($i=0;$i<count($zonal);$i++){
		   array_push($_zonal_name,$zonal[$i]);
		} 
	    $_zonal_name=json_encode($_zonal_name);
		$_zonal_name=str_replace( array('[',']','"') , ''  , $_zonal_name);
		$zonalarr=explode(',',$_zonal_name);
		$_zonal_name = "'" . implode ( "', '", $zonalarr )."'";
		
	    $_circle_name = [];
        for($i=0;$i<count($circle);$i++){
		   $_circle = explode("_",$circle[$i]);
		   array_push($_circle_name,$_circle[1]);
		} 
	    $_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";	
	}	
	if($_zonal_name!=""){
		$sql = mysqli_query($con,"select ATMID from ai_sites where ATMID IN (select ATMID from site_circle where Bank='".$bank."' AND Circle IN (".$_circle_name.")) AND live='Y' and Customer = '".$client."' and Bank='".$bank."'");
	}else{
		$sql = mysqli_query($con,"select ATMID from ai_sites where live='Y' and Customer = '".$client."' and Bank='".$bank."'");
	}
    
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		if($value!=''){
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
		}
	}

	/*$sql = mysqli_query($con,"select ATMID from ai_sites where live='Y' and Customer = '".$client."' and Bank='".$bank."'");
	
	$html = "<option value=''>All Site</option>";
	while($sql_result = mysqli_fetch_assoc($sql)){
		$value = $sql_result['ATMID']; 
		$newhtml = '<option value="'.$value.'">'.$value.'</option>';
		$html .= $newhtml;
	}*/
	return $html;
}