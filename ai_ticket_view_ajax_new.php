<?php session_start();include('db_connection.php'); ?>
<?php 

function getsitedetail($paramater,$atmid,$con){
	//global $con;

	$sql = mysqli_query($con,"select $paramater from sites where ATMID='".$atmid."'");
	$sql_result = mysqli_fetch_assoc($sql);
	return $sql_result[$paramater];
}
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

$portal =$_POST['portal'];
$start =$_POST['start'];
$end =$_POST['end'];
$client = $_POST['client'];
//$client = "Hitachi";
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
$circle = "";
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}
//$bank = "PNB";
$con = OpenCon();


	$atmidarray = [];
	
if($atmid!=''){
		$sitesql = mysqli_query($con,"select ATMID from sites where ATMID='".$atmid."' and live='Y'");
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
		
	}
	$atmidarray = [];
while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}

		
		
	

if($portal=="all"){
   $query = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."'"; 
}else{
	if($portal=="active"){
		$query = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."' AND status='O'"; 
	}else{
		$query = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."' AND status='C'"; 
	}
}

/*
if($portal=="all"){
	$_status = "";
}else{
	if($portal=="active"){
		$_status = "O";
	}else{ 
	    $_status = "C";
	}
}


    if($atmid!=''){
		if($_status==""){
			$query = "select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' ND CAST(createtime AS DATE)<='".$end."' ORDER BY createtime DESC";
		}else{
		    $query = "select * from ai_alerts where ATMCode like '%".$atmid."%' AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' ND CAST(createtime AS DATE)<='".$end."' AND status='".$_status."' ORDER BY createtime DESC";
		}
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
					if($_status==""){
						$query = "select * from ai_alerts where ATMCode IN (".$circleatmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' ND CAST(createtime AS DATE)<='".$end."' ORDER BY createtime DESC";
					}else{
						$query = "select * from ai_alerts where ATMCode IN (".$circleatmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start."' ND CAST(createtime AS DATE)<='".$end."' AND status='".$_status."' ORDER BY createtime DESC";
					}
			}else{ 
			    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
					
			} 
		 
		}else{ 
		    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank IN (".$_bank_name.") and a_s.live='Y' ORDER BY aaa.id DESC";
			
		}
		
	} */
	//echo $query;die;
	$sql = mysqli_query($con,$query);

    $total_site = mysqli_num_rows($sql); 
    if($total_site>0){
	    $key = 1;
		while($sql_result = mysqli_fetch_assoc($sql)){
			$src = $sql_result['File_loc'];
			$_atmid = trim($sql_result['ATMCode']);
			$_dvrip = "-";
			$_siteaddress = "-";
			$_status = 'Closed';
			if($sql_result['status']=='O'){
				$_status = 'Active';
			}
			$data_arr = [];
			$data_arr['id'] = $sql_result['id'];
			$data_arr['atm_id'] = $_atmid;
			$data_arr['alert_type'] = $sql_result['alerttype'];
			$data_arr['ip'] = $_dvrip;
			$data_arr['status'] = $_status;
			$data_arr['site_address'] = $_siteaddress;
			$data_arr['createtime'] = $sql_result['createtime'];;
			$data_arr['src'] = $src;
			array_push($_data,$data_arr);				
            $key++; 
		}
	}
	
	$array = array(['code'=>$code,'res_data'=>$_data]);

CloseCon($con);
echo json_encode(utf8ize($array));
?>

