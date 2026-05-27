<?php include('db_connection.php'); 
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
 ?>
<?php $client = 'Hitachi'; $userid=24;
   // $client = $_POST['client'];
   // $userid = $_POST['user_id'];
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

    $bank = "";$circle = "";
    $atmid = "";
	if(isset($_POST['bank'])){
	  $bank = $_POST['bank'];
	}
	if(isset($_POST['circle'])){
	  $circle = $_POST['circle'];
	}
	if(isset($_POST['atmid'])){
	  $atmid = $_POST['atmid'];
	}
	$query_date = date('Y-m-d');
	$splitdate = explode("-",$query_date);
	$day = $splitdate[2];
	$month = $splitdate[1];
	$year = $splitdate[0];

	$end_day = intval($day);

	$con = OpenCon();
	if($atmid!=''){
		$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where atmid='".$atmid."' and live='Y'");
		$count_sql_result = mysqli_fetch_assoc($count_sql);
		$_panelid = $count_sql_result['NewPanelID'];
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
					$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
		            $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");
			}else{ 
			     $sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
		         $count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
		 
		}else{
			$sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
			$count_sql = mysqli_query($con,"select NewPanelID,ATMID,SiteAddress from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
		
		while($count_sql_result = mysqli_fetch_assoc($count_sql)){
			$atmidarray[] = $count_sql_result['ATMID']; 
		    $atmCodearray[] = $count_sql_result['ATMID'];	
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	} 

	//echo $atmidarray;die;
	$_res_data = array();
	if($atmid!=''){ 
	    $aisql = mysqli_query($con,"select COUNT(id) as cnt,alerttype,createtime,ATMCode from ai_alerts where ATMCode = '".$atmid."' GROUP BY ATMCode,alerttype"); 
	}else{
		$ch = "select COUNT(id) as cnt,alerttype,createtime,ATMCode from ai_alerts where ATMCode IN (".$atmidarray.") GROUP BY ATMCode,alerttype";
		$aisql = mysqli_query($con,"select COUNT(id) as cnt,alerttype,createtime,ATMCode from ai_alerts where ATMCode IN (".$atmidarray.") GROUP BY ATMCode,alerttype"); 
	}
	echo $ch;die;
	if(mysqli_num_rows($aisql)>0){
			$j = 0;
			$alert_type_key = array();
			while($aisql_result = mysqli_fetch_assoc($aisql)){ 
				$final_count = 0;
			   $alert_type_name = ltrim($aisql_result['alerttype']);	
			   $atm_code = ltrim($aisql_result['ATMCode']);
			    if($alert_type_name!='alive-status'){
				if (in_array($atm_code, $atmCodearray)){
				   $cnt = 0;
				   $alert_type = $aisql_result['alerttype'];
				   if (array_key_exists($alert_type,$alert_type_key)){
					   
				   }else{
					   $alert_type_key[$alert_type] = 0;
				   }
				   $sli_query = "select alerttype,createtime,ATMCode from ai_alerts where ATMCode = '".$atm_code."' AND alerttype = '".$alert_type."' AND receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR)";
				  // echo $sli_query;die;
				   $single_aisql = mysqli_query($con,"select alerttype,createtime,ATMCode from ai_alerts where ATMCode = '".$atm_code."' AND alerttype = '".$alert_type."' AND receivedtime >= SUBDATE( NOW(), INTERVAL 24 HOUR)");
				   $cnt = mysqli_num_rows($single_aisql);
				   $alert_type_key[$alert_type] = $alert_type_key[$alert_type] + $cnt;
				   
				
				}
			  }
			}
			
			$alert_type_arr_count=count($alert_type_key);
			
			$i = 0;
			foreach($alert_type_key as $key=>$val){
				$_data = [];	
				$_data['value'] = $val; 
				$_data['label'] = $key;
				if($val>0){
				$_res_data[$i] = (object)$_data;
				$i++;
				}
			}
			
			
	}
	
$array = array(['ai_res_data'=>$_res_data]);
CloseCon($con);
echo json_encode($array);
//echo json_encode(utf8ize($array));
?>


