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
 
//$client = $_POST['client'];
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
	$bank = 'PNB';
	$count = 1 ; $camera_notworking_count = 0; $camera_working_count=0;$total_site=0;
	$_data = [];$_data_n = [];$_data_p = [];
	$code = 201;
	

	if($atmid!=''){
		$query = "SELECT ATMID from ai_sites WHERE ATMID='".$atmid."' and live='Y'";
		
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
					$query = "SELECT ATMID from ai_sites WHERE Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'";
			}else{ 
			    $query = "SELECT ATMID from ai_sites WHERE Customer='".$client."' and Bank='".$bank."' and live='Y'";
					
			} 
		 
		}else{ 
		    $query = "SELECT ATMID from ai_sites WHERE Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'";
			
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
				//echo '<pre>';print_r($atmfile_list_share);echo '</pre>';
				if($all_atm[$i]=='N3178600'){
						echo '<pre>';print_r($atmfile_list_share);echo '</pre>';die;
					}
				if(count($atmfile_list_share)>0){
					$check_date = '';$_thisfolder='';
					$year_arr = array();
					$month_arr = array();
					$date_arr = array();
					$file_arr = array();
					$_thisyear = 0;$_thismonth=0;
					for($z=0;$z<count($atmfile_list_share);$z++){
						if($atmfile_list_share[$z]!='desktop.ini'){
						   $filepath_explode = explode('/',$atmfile_list_share[$z]);
						  // echo '<pre>';print_r($filepath_explode);echo '</pre>';
						   if(count($filepath_explode)==3){
							   $date_explode = explode('_',$filepath_explode[2]);
							   if(count($date_explode)==3){
								  array_push($year_arr,$date_explode[0]);
								 // array_push($month_arr,$date_explode[1]);
							   }
						   }
						}
					}
					
					if(count($year_arr)>0){
						$_thisyear = max($year_arr);
						for($z=0;$z<count($atmfile_list_share);$z++){
							if($atmfile_list_share[$z]!='desktop.ini'){
								$filepath_explode = explode('/',$atmfile_list_share[$z]);
								if(count($filepath_explode)==3){
									$date_explode = explode('_',$filepath_explode[2]);
									if(count($date_explode)==3){
										if($date_explode[0]==$_thisyear){
											array_push($month_arr,$date_explode[1]);
											//array_push($date_arr,$date_explode[2]);
											//array_push($file_arr,$filepath_explode[2]);
										}
									}
								}
							}
						}
					}
					if(count($month_arr)>0){
						$_thismonth = max($month_arr);
						for($z=0;$z<count($atmfile_list_share);$z++){
							if($atmfile_list_share[$z]!='desktop.ini'){
								$filepath_explode = explode('/',$atmfile_list_share[$z]);
								if(count($filepath_explode)==3){
									$date_explode = explode('_',$filepath_explode[2]);
									if(count($date_explode)==3){
										if($date_explode[1]==$_thismonth){
											//array_push($month_arr,$date_explode[1]);
											array_push($date_arr,$date_explode[2]);
											//array_push($file_arr,$filepath_explode[2]);
										}
									}
								}
							}
						}
					}
					
					if($_thisyear>0 && $_thismonth>0 && count($date_arr)>0){
				        $max_key = array_keys($date_arr, max($date_arr));
						$check_date =  $_thisyear."_".$_thismonth."_".max($date_arr);
						$createdate = str_replace('_','-',$check_date);
						$file_name = $max_key;
						//$check_date = max($year_arr)."_".$_thismonth."_".max($date_arr);
						$path1 = $path."/".$check_date;
						$mainfile_list_share = ftp_nlist($ftp_conn,$path1);
						//echo '<pre>';print_r($mainfile_list_share);echo '</pre>';
						$last_folder_arr = array();
						if(count($mainfile_list_share)>0){
							for($z=0;$z<count($mainfile_list_share);$z++){
								$folderfilepath_explode = explode('/',$mainfile_list_share[$z]);
								if(count($folderfilepath_explode)==4){
								   array_push($last_folder_arr,$folderfilepath_explode[3]);
								}
							}
						}
						//echo '<pre>';print_r($last_folder_arr);echo '</pre>';echo max($last_folder_arr);die;
						if(count($last_folder_arr)>0){
							$max_folder = max($last_folder_arr);
							$_thisfolder_strt = (int)$max_folder;
					        $_thisfolder_end = $_thisfolder_strt + 1;
							    if($_thisfolder_strt>11){
								   $strt_time = $_thisfolder_strt." PM";
							    }else{
								   $strt_time = $_thisfolder_strt." AM";
							    }
							    if($_thisfolder_end>11){
								   $end_time = $_thisfolder_end." PM";
							    }else{
								   $end_time = $_thisfolder_end." AM";
							    }
							$sentence = $strt_time." - ".$end_time ; 
							$createdatetime = $createdate.', '.$sentence;
							$videofolder = $path1."/".$max_folder;
							$videofile_list_share = ftp_nlist($ftp_conn,$videofolder);
							//echo $createdatetime;
						   // echo '<pre>';print_r($videofile_list_share);echo '</pre>';
							
							if(count($videofile_list_share)>0){
								$file_hr_arr = array();
								$file_sec_arr = array();
								for($z=0;$z<count($videofile_list_share);$z++){
									$videofolderfilepath_explode = explode('/',$videofile_list_share[$z]);
									//echo '<pre>';print_r($videofolderfilepath_explode);echo '</pre>';
									if(count($videofolderfilepath_explode)==5){
									   $_file_hour = explode('_',$videofolderfilepath_explode[4]);	 
                                      // echo '<pre>';print_r($_file_hour);echo '</pre>';die;	
									   if(count($_file_hour)==4){
									      array_push($file_hr_arr,$_file_hour[2]);
										  $min_sec = $_file_hour[2].":".$videofolderfilepath_explode[4];
										  array_push($file_sec_arr,$min_sec);
									   }
									}
								}
								if(count($file_hr_arr)>0){
									$max_hr = max($file_hr_arr);
									for($z=0;$z<count($file_sec_arr);$z++){
										$minsecfolderfilepath_explode = explode(':',$file_sec_arr[$z]);
										if(count($minsecfolderfilepath_explode)==2){
										   if($minsecfolderfilepath_explode[0]==$max_hr){
											   $_lastuploadedfile = $minsecfolderfilepath_explode[1];
										   }
										}
									}
							    }
							}
							//echo '<pre>';print_r($file_hr_arr);echo '</pre>'; die;
						}else{
							$createdatetime = 'No Time Folder';
							$_lastuploadedfile = "No File Uploaded";
						}
						
					}else{
						$createdatetime = 'No Time Folder';
						$_lastuploadedfile = "No File Uploaded";
					}
					
				}else{
					$createdatetime = 'No Date Folder';
					$_lastuploadedfile = "No File Uploaded";
				}
				
				    $data_arr = [];
					$data_arr['atm_id'] = $all_atm[$i];
					$data_arr['createdatetime'] = $createdatetime;
					$data_arr['created_date'] = $createdatetime;
					$data_arr['file_name'] = $_lastuploadedfile;
					if($all_atm[$i]=='N3178600'){
						echo $createdatetime."____".$_lastuploadedfile;die;
					}
					/*$data_arr['ch'] = $max_key;
					$data_arr['dt_arr'] = $last_folder_arr;
					$data_arr['file'] = $folder_list_share; */
				if($createdatetime=='No Time Folder' || $createdatetime=='No Date Folder'){
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
	
$array = array(['code'=>200,'res_data'=>$_data,'camera_working_count'=>$camera_working_count,'camera_notworking_count'=>$camera_notworking_count,'tot_sites'=>$total_site]);

CloseCon($con);
echo json_encode(utf8ize($array));
//echo json_encode($array);
?>