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
	$count = 1 ; $video_notfound_count = 0; $video_found_count=0;$atm_not_found=0;
	$_data = [];$_data_n = [];$_data_p = [];
	$code = 201;
	

	if($atmid!=''){
		$query = "SELECT ATMID from sites WHERE ATMID='".$atmid."' and live='Y'";
		
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
					$query = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";
			}else{ 
			    $query = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank='".$bank."' and live='Y'";
					
			} 
		 
		}else{ 
		    $query = "SELECT ATMID from sites WHERE Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
			
		}
		
	}
	//echo $query;
	
	$atmidlist = mysqli_query($con,$query);
	$totalsite = mysqli_num_rows($atmidlist); 
	  $atmidlistarr = array();
	  if(mysqli_num_rows($atmidlist)>0){
		  while($atmid_data=mysqli_fetch_assoc($atmidlist)){
			 $clientatmid = $atmid_data['ATMID']; 
			 array_push($atmidlistarr,$clientatmid);
		  }
	  }
	
	//$ftp_conn = OpenFTPCon();
	$ftp_conn = OpenComfortFTPCon();
	$ftp_pasv = ftp_pasv($ftp_conn,true);
	 
	$file_list = ftp_nlist($ftp_conn, ".");
	$today_date = date('Y-m-d');
	/*
	for($i=0;$i<count($file_list);$i++){
		if($file_list[$i]=='AI_Feed'){
		    $file_list_share = ftp_nlist($ftp_conn, "AI_Feed");
		    for($j=0;$j<count($file_list_share);$j++){
				$atm = $file_list_share[$j]; 
				if($atm!='desktop.ini'){
					for($p=0;$p<count($atmidlistarr);$p++){
						if($atm==$atmidlistarr[$p]){
						   $all_atm[]=$atm;
						}
					}
				}
			}	  
		}
	}
	*/
	$all_atm = $atmidlistarr;
	//echo '<pre>';print_r($all_atm);echo '</pre>';die;
	if(count($all_atm)>0){
		for($i=0;$i<count($all_atm);$i++){
			//$path = "AI_Feed/".$all_atm[$i];
			
			if($all_atm[$i]!='desktop.ini'){
				$path = "AI_Feed/".$all_atm[$i];
				$atmfile_list_share = ftp_nlist($ftp_conn,$path);
				//echo '<pre>';print_r($atmfile_list_share);echo '</pre>';die;
				if(count($atmfile_list_share)>0){
					$check_date = '';$_thisfolder='';
					$year_arr = array();
					$month_arr = array();
					$date_arr = array();
					for($z=0;$z<count($atmfile_list_share);$z++){
						if($atmfile_list_share[$z]!='desktop.ini'){
						   $filepath_explode = explode('/',$atmfile_list_share[$z]);
						  // echo '<pre>';print_r($filepath_explode);echo '</pre>';die;
						   if(count($filepath_explode)==3){
							   $date_explode = explode('_',$filepath_explode[2]);
							   if(count($date_explode)==3){
								  
								  array_push($month_arr,$date_explode[1]);
							   }
						   }
						}
					}
					//echo '<pre>';print_r($month_arr);echo '</pre>';die;
					if(count($month_arr)>0){
						$_thismonth = max($month_arr);
						for($z=0;$z<count($atmfile_list_share);$z++){
							if($atmfile_list_share[$z]!='desktop.ini'){
								$filepath_explode = explode('/',$atmfile_list_share[$z]);
								if(count($filepath_explode)==3){
									$date_explode = explode('_',$filepath_explode[2]);
									if(count($date_explode)==3){
										if($date_explode[1]==$_thismonth){
											array_push($year_arr,$date_explode[0]);
											array_push($date_arr,$date_explode[2]);
										}
									}
								}
							}
						}
					}
					if(count($year_arr)>0 && count($date_arr)>0){
				
						$check_date = max($year_arr)."_".$_thismonth."_".max($date_arr);
						$path1 = $path."/".$check_date;
						$mainfile_list_share = ftp_nlist($ftp_conn,$path1);
						$last_folder_arr = array();
						if(count($mainfile_list_share)>0){
							for($z=0;$z<count($mainfile_list_share);$z++){
								array_push($last_folder_arr,$mainfile_list_share[$z]);
							}
						}
						if(count($last_folder_arr)>0){
							$_thisfolder = max($last_folder_arr);
							/*$last_folder_path = $path1."/".$_thisfolder;
							$folder_list_share = ftp_nlist($ftp_conn_1,$last_folder_path);
							echo '<pre>';print_r($folder_list_share);echo '</pre>'; */
						}
					}
					
					if($check_date!=''){
					  $createdate = str_replace('_','-',$check_date);
					  $_thisfolder_strt = (int)$_thisfolder;
					  $_thisfolder_end = $_thisfolder_strt + 1;
					  if($_thisfolder_strt>11){
						  $strt_time = $_thisfolder_strt." PM";
					  }else{
						  if($_thisfolder_strt==0){
							  $_thisfolder_strt = 12;
						  }
						  $strt_time = $_thisfolder_strt." AM";
					  }
					  if($_thisfolder_end>11){
						  $end_time = $_thisfolder_end." PM";
					  }else{
						  $end_time = $_thisfolder_end." AM";
					  }
					  $sentence = $strt_time." - ".$end_time ; 
					  $createdatetime = $createdate.', '.$sentence;
					   $video_found_count = $video_found_count + 1;
					}else{
					   $createdatetime = 'Not Found Video';	
					   $video_notfound_count = $video_notfound_count + 1;
					}
					
					
				}else{
					$createdate = "";
					$createdatetime = 'Not Found';
					$atm_not_found = $atm_not_found + 1;
				}
				
				$data_arr = [];
				$data_arr['atm_id'] = $all_atm[$i];
				$data_arr['createdatetime'] = $createdatetime;
				$data_arr['created_date'] = $createdatetime;
				$data_arr['file_name'] = $check_date;
				
				if($createdatetime=='Not Found Video' || $createdatetime=='Not Found'){
					array_push($_data_n,$data_arr);
				}else{
				    
					array_push($_data_p,$data_arr);
				}
			}
				
		}
	}
	
	if(count($_data_n)>0){
		$_data = array_merge($_data_p,$_data_n);
	}else{
		$_data = $_data_p;
	}
	
$array = array(['code'=>200,'res_data'=>$_data,'video_found_count'=>$video_found_count,'video_notfound_count'=>$video_notfound_count,'atm_not_found'=>$atm_not_found]);

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>