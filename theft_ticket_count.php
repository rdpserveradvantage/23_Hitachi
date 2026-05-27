<?php //include('config.php'); ?>
<?php session_start();include('db_connection.php'); $con = OpenCon();
 date_default_timezone_set('Asia/Kolkata');
  function datetimediff($datetime){
	    $datetime1 = new DateTime();
		$datetime2 = new DateTime($datetime);
		$interval = $datetime1->diff($datetime2);
		//$elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
		$elapsed = $interval->format('%i');
		return $elapsed;
  }
?>
<?php 
$client = $_POST['client'];
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
if(isset($_POST['bank'])){
$bank = $_POST['bank'];
}
if(isset($_POST['atmid'])){
$atmid = $_POST['atmid'];
}
if(isset($_POST['circle'])){
$circle = $_POST['circle'];
}

$status = 'all';
if($atmid!=''){
	if($status=='all'){
$sql = mysqli_query($con,"select * from theft_ticket_raise where atmid='".$atmid."' order by id desc"); 		
	}else{
//$sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' and status='".$status."' order by id desc"); 
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
				$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
			}else{
		          $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
			} 
	  
	}else{
		$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
	}
	
	while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		//$atmidarray[] = $sitesql_result['ATMID'];
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	if($status=='all'){
		$onlinetestsql = "SELECT * FROM theft_ticket_raise WHERE atmid IN (".$atmidarray.") order by id desc";
	}else{
	  //  $onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
	}
    $sql = mysqli_query($con,$onlinetestsql);
}
if(!$sql || mysqli_num_rows($sql)==0){
	$theft_count = 0;
}else{
$theft_count = mysqli_num_rows($sql);
}
$array = array(['theft_count'=>$theft_count]);

CloseCon($con);
echo json_encode($array);
?>



