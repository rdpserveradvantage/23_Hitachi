<?php include('db_connection.php'); ?>
<?php 
function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}
function getsitedetail($paramater,$atmid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
//$client = $_POST['client'];
$client = 'Hitachi';
$userid = $_POST['user_id'];
$con = OpenCon();
$usersql = mysqli_query($con,"select cust_id,bank_id,circle_id from loginusers where id='".$userid."'");
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


$_circle_ids = $userdata['circle_id'];
	$_circle_name = "";
		$_circle_name_array = array();
		if($_circle_ids!=''){
		    $assign_circle = explode(",",$_circle_ids);
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
			if(count($_circle_name_array)>0){
				$_circle_name_array1=json_encode($_circle_name_array);
				$_circle_name_array1=str_replace( array('[',']','"') , ''  , $_circle_name_array1);
				$circlearr_atm=explode(',',$_circle_name_array1);
				$_circle_name_array1 = "'" . implode ( "', '", $circlearr_atm )."'";
			}	
		}
		
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
$start = $_POST['start'];
$end = $_POST['end'];
$portal = $_POST['portal'];
$con = OpenCon();


if($atmid!=''){
	$sitesql = mysqli_query($con,"select * from sites where atmid='".$atmid."' and live='Y'");
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
				$sitesql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
				if($_circle_ids!=''){
					$sitesql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$_circle_name_array1.") and live='Y'");
				}else{
		         $sitesql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				}
			} 
	  
	}else{
		if($client=='All'){
		$sitesql = mysqli_query($con,"select * from sites where live='Y'");	
		}else{
		$sitesql = mysqli_query($con,"select * from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
	}
	
}


    $atmidarray = [];
	if(mysqli_num_rows($sitesql)>0){
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			$atmidarray[] = $sitesql_result['ATMID'];
			
		}
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	


if($portal=="All"){
$sql = mysqli_query($con,"select * from alert_ticket_raise where atmid IN (".$atmidarray.") AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC"); 
$_qry_sql = "select * from alert_ticket_raise where atmid IN (".$atmidarray.") AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC";
}else{
	$sql = mysqli_query($con,"select * from alert_ticket_raise where atmid IN (".$atmidarray.") AND ticket_status='".$portal."' AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC"); 
$_qry_sql = "select * from alert_ticket_raise where atmid IN (".$atmidarray.") AND ticket_status='".$portal."' AND CAST(created_date AS DATE)>='".$start."' 
                          AND CAST(created_date AS DATE)<='".$end."' ORDER BY id DESC";
}

//echo json_encode($sql_result);
?>

					    <?php  
                        $res_data = [];
                        $count = 1 ; 
						$_cnt = mysqli_num_rows($sql);
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){ 
							    
								$_status = 'Closed';
								if($sql_result['ticket_status']=='1'){
									$_status = 'Pending';
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
								
								$_newarr['ticketid'] = $sql_result['ticket_id'];
								$_newarr['alarm_type'] = $sql_result['alarm_type'];
								$_newarr['atmid'] = $sql_result['atmid'];
								$_newarr['location'] = htmlspecialchars($sql_result['location']);
								$_newarr['alerttype'] = $sql_result['alert_type'];
								$_newarr['created_time'] = $sql_result['created_date'];
								$_newarr['close_date'] = $sql_result['close_date'];
								$_newarr['status'] = $_status;
								$_newarr['remarks'] = $sql_result['remarks'];
								array_push($res_data,$_newarr);
							  ?>
							  
						<?php }
						  }
						?>
                      

<?php 


if(count($res_data)>0){
	$array = array(['Code'=>200,'res_data'=>$res_data]);
}else{
	$array = array(['Code'=>201,'qer'=>$_cnt,'qr'=>$_qry_sql]);
}


CloseCon($con);
echo json_encode(utf8ize($array));
?>
