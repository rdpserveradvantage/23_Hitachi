<?php session_start();include('db_connection.php'); $con = OpenCon(); ?>
<?php 
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
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
	
	$_circle_name = "";
	$_circle_name_array = array();
	if($_SESSION['circlename']!=''){
	   $assign_circle = explode(",",$_SESSION['circlename']);
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
	}

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




//"SELECT * FROM `ai_alerts` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode";

	if($atmid!=''){
		$query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive1 WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive1` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.ATMID='".$atmid."' and a_s.live='Y' ORDER BY aaa.id DESC";
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
					$query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive1 WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive1` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.ATMID IN (".$circleatmidarray.") and a_s.live='Y' ORDER BY aaa.id DESC";
			}else{ 
			    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive1 WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive1` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
			} 
		}else{ 
		    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime,aaa.receivedtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime,receivedtime FROM ai_alerts_alive1 WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive1` WHERE receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank IN (".$_bank_name.") and a_s.live='Y' ORDER BY aaa.id DESC";
		}
	}
	//echo $query;die;
	$sql = mysqli_query($con,$query);
	// 
    $count = 1 ; $camera_notworking_count = 0; $camera_working_count=0;$total_site=0;
	$_data = [];
	$code = 201;
	$totalsite = mysqli_num_rows($sql); 
    if($totalsite>0){
	    $key = 1;
		while($sql_result = mysqli_fetch_assoc($sql)){
			
            $atm_id = $sql_result['ATMID'];$str='';$createdatetime='-';
			$_view = 0;
			if(count($_circle_name_array)==0){
				$_view = 1;
			}else{
				if(in_array($atm_id,$_circle_name_array)){
				   $_view = 1;
				}
			}
		   // $ai_alert_sql = mysqli_query($con,"select File_loc,createtime,alerttype,sendip from ai_alerts_alive1 where createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) AND ATMCode like '%".$atm_id."%' ORDER BY id desc LIMIT 1"); 
			$src = "";$path="";$camerastatus ="not working";
			$ticket_id = $sql_result['ID'];
			if($_view == 1){
				$total_site = $total_site + 1;
				if($ticket_id){
					$src = $ticket_id;
				  //  $src = $sql_result['File_loc'];
					//$createdatetime = $sql_result['createtime'];	receivedtime
					$createdatetime = $sql_result['receivedtime'];
					$sendip = $sql_result['sendip'];	
					
					$camerastatus ="working";
					$AlertType = $sql_result['alerttype'];
					$Customer = $sql_result['Customer'];$Bank = $sql_result['Bank'];$SiteAddress=$sql_result['SiteAddress']	;
					$ATMID = $sql_result['ATMID'];$City = $sql_result['City'];$State=$sql_result['State'];$Zone = $sql_result['Zone'];
					$NewPanelID=$sql_result['NewPanelID']	;
					$live = $sql_result['live'];$Password = $sql_result['Password'];$UserName=$sql_result['UserName'];$DVRName = $sql_result['DVRName'];
					$DVRIP=$sql_result['DVRIP'];$PanelsIP = $sql_result['PanelIP'];$SN = $sql_result['SN'];	
					
					$ai_site_sql = mysqli_query($con,"select id from ai_sites where SN='".$SN."'"); 
					if(mysqli_num_rows($ai_site_sql)==0){
							$insert_sql="insert into ai_sites(Project,Customer,Bank,ATMID,Location,SiteAddress,City,State,Zone,NewPanelID,DVRIP,DVRName,UserName,Password,live,rtsp_stream,pie_username,pie_pwd,PanelIP,AlertType,SN)
						   values('','".$Customer."','".$Bank."','".$ATMID."','".$SiteAddress."','".$SiteAddress."','".$City."','".$State."','".$Zone."','".$NewPanelID."','".$DVRIP."','".$DVRName."','".$UserName."','".$Password."','".$live."','','','','".$PanelsIP."','".$AlertType."','".$SN."')";
						   $result=mysqli_query($con,$insert_sql) ;  
					}
					 $camera_working_count = $camera_working_count + 1;
					// $camerastatus = "working";
				}else{
				   $camera_notworking_count = $camera_notworking_count + 1;
				}
				
				$data_arr = [];
				$data_arr['atm_id'] = $sql_result['ATMID'];
				$data_arr['ip'] = $sql_result['DVRIP'];
				$data_arr['state'] = $sql_result['State'];
				$data_arr['camera_status'] = $camerastatus ;
				$data_arr['site_address'] = $sql_result['SiteAddress'];
				$data_arr['createdatetime'] = $createdatetime;
				$data_arr['src'] = $src;
				$data_arr['path'] = $path;
				array_push($_data,$data_arr);				
				$key++; 
				
			}	
		}
		$code = 200;
	}
	
$array = array(['code'=>$code,'res_data'=>$_data,'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,'tot_ai_sites'=>$total_site]);

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>