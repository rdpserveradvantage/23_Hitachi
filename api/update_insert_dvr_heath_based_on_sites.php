<?php session_start();include('db_connection.php');  ?>
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




//$client = $_POST['client'];
/*
$client = "Hitachi";
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



//"SELECT * FROM `ai_alerts` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode";

	if($atmid!=''){
		$query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.ATMID='".$atmid."' and a_s.live='Y' ORDER BY aaa.id DESC";
		
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
					$query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.ATMID IN (".$circleatmidarray.") and a_s.live='Y' ORDER BY aaa.id DESC";
			}else{ 
			    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank='".$bank."' and a_s.live='Y' ORDER BY aaa.id DESC";
					
			} 
		 
		}else{ 
		    $query = "SELECT a_s.*,aaa.ATMCode,aaa.alerttype,aaa.File_loc,aaa.id as ID,aaa.sendip,aaa.createtime FROM ai_sites a_s LEFT JOIN (SELECT id,ATMCode,alerttype,File_loc,sendip,createtime FROM ai_alerts_alive WHERE id IN (SELECT MAX(id) AS id FROM `ai_alerts_alive` WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) GROUP BY ATMCode)) AS aaa ON a_s.ATMID=aaa.ATMCode WHERE a_s.Customer='".$client."' and a_s.Bank IN (".$_bank_name.") and a_s.live='Y' ORDER BY aaa.id DESC";
			
		}
		
	}
	echo $query;die; */
$con = OpenCon();
$ai_query = "SELECT ATMCode FROM ai_alerts_alive WHERE createtime >= SUBDATE( NOW(), INTERVAL 24 HOUR) AND ATMCode NOT IN (SELECT ATMID FROM ai_sites WHERE live='Y') GROUP BY ATMCode";
$mysql_query_ai = mysqli_query($con,$ai_query); 
$count_inserted = 0;
while($ai_sql_result = mysqli_fetch_assoc($mysql_query_ai)){
	$_atmid_val = $ai_sql_result['ATMCode'];
	//$q = "select * from sites where ATMID='".$_atmid_val."'";
	$_site_table_sql = mysqli_query($con,"select * from sites where ATMID='".$_atmid_val."'");
	
	if(mysqli_num_rows($_site_table_sql)>0){ 
	    $sql_result = mysqli_fetch_assoc($_site_table_sql);
		
	    $Customer = $sql_result['Customer'];$Bank = $sql_result['Bank'];$SiteAddress=$sql_result['SiteAddress']	;
				$ATMID = $sql_result['ATMID'];$City = $sql_result['City'];$State=$sql_result['State'];$Zone = $sql_result['Zone'];
				$NewPanelID=$sql_result['NewPanelID']	;
				$live = $sql_result['live'];$Password = $sql_result['Password'];$UserName=$sql_result['UserName'];$DVRName = $sql_result['DVRName'];
				$DVRIP=$sql_result['DVRIP'];$PanelsIP = $sql_result['PanelIP'];$SN = $sql_result['SN'];	
				$insert_sql="insert into ai_sites(Project,Customer,Bank,ATMID,Location,SiteAddress,City,State,Zone,NewPanelID,DVRIP,DVRName,UserName,Password,live,rtsp_stream,pie_username,pie_pwd,PanelIP,AlertType,SN)
					   values('','".$Customer."','".$Bank."','".$ATMID."','".$SiteAddress."','".$SiteAddress."','".$City."','".$State."','".$Zone."','".$NewPanelID."','".$DVRIP."','".$DVRName."','".$UserName."','".$Password."','".$live."','','','','".$PanelsIP."','alive-status','".$SN."')";
				// echo $insert_sql;die;	  
					   $result=mysqli_query($con,$insert_sql) ; 
					   if($result){
						   $count_inserted = $count_inserted + 1;
					   }
	}
}
 echo "Total sites inserted in ai sites : ".$count_inserted;
CloseCon($con);

?>