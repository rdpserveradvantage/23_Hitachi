<?php include('db_connection.php'); ?>
<?php 

function getsitedetail($paramater,$atmid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
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
    $atmid = "";
	if(isset($_POST['bank'])){
	$bank = $_POST['bank'];
	}
	if(isset($_POST['atmid'])){
	$atmid = $_POST['atmid'];
	}
$start = $_POST['start'];
$end = $_POST['end'];
$portal = $_POST['portal'];
$con = OpenCon();


if($portal=="all"){
$sql = mysqli_query($con,"select status,id,alerttype,receivedtime,File_loc from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype not like '%alive-status%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' ORDER BY id DESC"); 
}else{
	if($portal=="active"){
		$sql = mysqli_query($con,"select status,id,alerttype,receivedtime,File_loc from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND alerttype not like '%alive-status%' AND status='O' ORDER BY id DESC"); 
	}else{
		$sql = mysqli_query($con,"select status,id,alerttype,receivedtime,File_loc from ai_alerts where ATMCode like '%".$atmid."%' AND CAST(createtime AS DATE)>='".$start."' 
                          AND CAST(createtime AS DATE)<='".$end."' AND alerttype not like '%alive-status%' AND status='C' ORDER BY id DESC"); 
	}
}

//echo json_encode($sql_result);
?>

					    <?php  
                        $res_data = [];
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    $str = $sql_result['File_loc'];
								$src = "";
								if($str!=''){
									//$files = explode("/",$str);
								/*	$files = str_replace('./Record','',$str);
									//$file = $files[2];
									$file = str_replace('/','\\',$files);
									$path = "D:\\python_codes\\Server_socket\\Record\\$file";
									if(file_exists($path)){
										$imgData = base64_encode(file_get_contents($path)); 
										$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
									}  */
									$src = 'data: jpeg;base64,'.$str; 
								}
								$_status = 'Closed';
								if($sql_result['status']=='O'){
									$_status = 'Active';
								}
								/*
								$sitesql = mysqli_query($con,"select SiteAddress,DVRIP from sites where ATMID='".$atmid."'");
								$siteaddress = "";$dvrip = "";
								if(mysqli_num_rows($sitesql)>0){
	                            $site_sql_result = mysqli_fetch_assoc($sitesql);
								$siteaddress = $site_sql_result['SiteAddress'];
								$dvrip = $site_sql_result['DVRIP'];
								}
								*/
								$_newarr = array();
								
								$_newarr['ticketid'] = $sql_result['id'];
								//$_newarr['siteaddress'] = $siteaddress;
								//$_newarr['dvrip'] = $dvrip;
								$_newarr['alerttype'] = $sql_result['alerttype'];
								$_newarr['createtime'] = $sql_result['receivedtime'];
								$_newarr['status'] = $_status;
								$_newarr['src'] = $src;
								array_push($res_data,$_newarr);
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
