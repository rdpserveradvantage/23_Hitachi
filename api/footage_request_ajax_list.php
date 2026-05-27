<?php include('db_connection.php'); ?>
<?php 

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

if($atmid!=''){
$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."'"); 

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
	
	//$atmidarray = [];
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = $sitesql_result['ATMID'];
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	
	$onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.")";
    $sql = mysqli_query($con,$onlinetestsql);
}
    $_data = []; 
    $count = 1 ; 
	if(mysqli_num_rows($sql)>0){
		while($sql_result = mysqli_fetch_assoc($sql)){
			$data_arr = [];
			$data_arr['id'] = $sql_result['id'];
		    $data_arr['atmid'] = $sql_result['atmid'];
		    $data_arr['card_no'] = $sql_result['card_no'];
		    $data_arr['date_of_TXN'] = $sql_result['date_of_TXN'];
			$data_arr['time_of_TXN'] = $sql_result['time_of_TXN'];
		    $data_arr['nature_of_TXN'] = $sql_result['nature_of_TXN'];
		    $data_arr['amount_of_TXN'] = $sql_result['amount_of_TXN'];
			$data_arr['txn_no'] = $sql_result['txn_no'];
		    $data_arr['complaint_no'] = $sql_result['complaint_no'];
		    $data_arr['complaint_date'] = $sql_result['complaint_date'];
            $data_arr['claim_date'] = $sql_result['claim_date'];      
            array_push($_data,$data_arr);                   
		}
	}
	$array = array(['res_data'=>$_data]);					
CloseCon($con);
echo json_encode($array);
?>

