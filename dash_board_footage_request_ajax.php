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
	//$bank = 'PNB';
	$count = 1 ; $video_notfound_count = 0; $video_found_count=0;$atm_not_found=0;$total_request = 0;
	$_data = [];$_data_n = [];$_data_p = [];
	$code = 201;
	

	if($atmid!=''){
		$sitesql = "SELECT ATMID from sites WHERE ATMID='".$atmid."' and live='Y'";
		
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
					$sitesql = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";
			}else{ 
			    $sitesql = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank='".$bank."' and live='Y'";
					
			} 
		 
		}else{ 
		    $sitesql = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
			
		}
		
	}
	//echo $query;
	 $sitesql_qry = mysqli_query($con,$sitesql);
	while($sitesql_result = mysqli_fetch_assoc($sitesql_qry)){
		//$atmidarray[] = $sitesql_result['ATMID'];
		$_is_atmid = $sitesql_result['ATMID'];
		if(count($_circle_name_array)==0){
			$atmidarray[] = $_is_atmid;
		}else{
			if(in_array($_is_atmid,$_circle_name_array)){
			   $atmidarray[] = $_is_atmid;
			}
		}
		//array_push($atmidarray,(string)$atmid);
	}
	$atmidarray=json_encode($atmidarray);
	$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
	$arr=explode(',',$atmidarray);
	$atmidarray = "'" . implode ( "', '", $arr )."'";
	$status = "all";
	if($status=='all'){
		$onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") order by id desc";
	}else{
	    $onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
	}
    $sql = mysqli_query($con,$onlinetestsql);
	
	if(mysqli_num_rows($sql)>0){
	  while($sql_result = mysqli_fetch_assoc($sql)){  
	    $total_request = $total_request + 1;
		$_atmid = $sql_result['atmid']; 
		if($sql_result['is_available']==0){
			$createdatetime = 'No Video';	
			$atm_not_found = $atm_not_found + 1;
			
		}else{
			if($sql_result['is_checked']==0){
				$createdatetime = 'Processing';	
				$video_notfound_count = $video_notfound_count + 1;
				
			}else{
				if($sql_result['footage_avail']=='Yes'){
					$video_found_count = $video_found_count + 1;
					$file_url_files = json_encode($sql_result['downlink']);
					//$file_url = json_decode($file_url_files,true);
					$createdatetime = 'Available';
					//echo '<pre>';print_r($file_url);echo '</pre>';
				}else{
					$file_url = [];
					$createdatetime = 'Not Found';
					$video_notfound_count = $video_notfound_count + 1;
				}
			}
		}
		
		
		$data_arr = [];
		$data_arr['atm_id'] = $_atmid;
		$data_arr['footage'] = $file_url;
		$data_arr['status'] = $createdatetime;
		if($createdatetime=='No Video' || $createdatetime=='Not Found' || $createdatetime=='Processing'){
			array_push($_data_n,$data_arr);
		}else{
			
			array_push($_data_p,$data_arr);
		}
	  }
	}
	
	if(count($_data_n)>0){
		$_data = array_merge($_data_p,$_data_n);
	}else{
		$_data = $_data_p;
	}
	
$array = array(['code'=>200,'res_data'=>$_data,'video_found_count'=>$video_found_count,'video_notfound_count'=>$video_notfound_count,'atm_not_found'=>$atm_not_found,'total_request'=>$total_request]);

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>