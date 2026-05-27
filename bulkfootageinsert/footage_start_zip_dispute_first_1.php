<?php
include('db_connection.php');
$month_array = ["January","February","March","April","May","June","July","August","September","October","November","December"];
function curl_get_file_contents($URL)
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_URL, $URL);
        $contents = curl_exec($c);
        curl_close($c);

        if ($contents) return $contents;
        else return FALSE;
    }
function create_zip($files = array(),$destination = '',$overwrite = false) {
	$count_file = count($files);
	//if the zip file already exists and overwrite is false, return false
	if(file_exists($destination) && !$overwrite) { return false; }
	//vars
	$valid_files = array();
	//if files were passed in...
	if(is_array($files)) {
		//cycle through each file
		foreach($files as $file) {
			//make sure the file exists
			if(file_exists($file)) {
				$valid_files[] = $file;
			}
		}
	}
	//if we have good files...
	if(count($valid_files)) {
		//create the archive
		$zip = new ZipArchive();
		if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
			return false;
		}
		//add the files
		foreach($valid_files as $file) {
			$zip->addFile($file,$file);
		}
		//debug
		//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
		
		//close the zip -- done!
		$zip->close();
		
		//check to make sure the file exists
		if($zip->numFiles==$count_file)
		   return file_exists($destination);
	}
	else
	{
		return false;
	}
}	
	 /*
	date_default_timezone_set("Asia/Calcutta"); 
	$current_datetime = date('Y-m-d H:i:s');
	$now   = time();
	$today_date = date('Y-m-d');
	$this_month = date('m');
	$mon = $month_array[$this_month - 1];
	$dt = str_replace("-","_",$today_date);
	
	$ftp_conn_local = OpenComfortFTPLocalCon();
	$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
	
	$folder_path = "Footage_Upload"; 				
	$file_list = ftp_nlist($ftp_conn_local, $folder_path);
	

	$getimagesql = "SELECT * FROM `footage_details_available` WHERE month='".$mon."' AND dt='".$dt."' AND footage_type='Normal'"; 
	
	$getimagesdata = mysqli_query($con,$getimagesql);
	$check_arr = array();
	
	if(mysqli_num_rows($getimagesdata)>0){
		while($foot_data = mysqli_fetch_assoc($getimagesdata)){
			$fol_atmid = $foot_data['atmid'];
			$seq = $mon."_".$dt."_".$fol_atmid;
			array_push($check_arr,$seq);
		}
		
	}
	
	 mysqli_close($con);
	 */

	    date_default_timezone_set("Asia/Calcutta"); 
		$current_datetime = date('Y-m-d H:i:s');
		$today_date = date('Y-m-d');
		
		$dt = $_POST['dt'];
		$yr = $_POST['yr'];
		//$dt = '2024_08_02';
		//$yr = '2024';
		$date_split = explode('_',$dt);
		$mon_split_val = $date_split[1];
		$month_tbl = (int)$mon_split_val;
		
	    $mon = $month_array[$month_tbl - 1];
		
		$con = OpenCon();
     /* 
	    $atm_val = $_POST['atm_val'];
        $atmimagepath = $_POST['atmid'];
		$mon_dt_arr = explode("/",$atmimagepath);
		$fol_mon = $mon_dt_arr[0];
		$fol_dt = $mon_dt_arr[1];
	 */	
       // $fileName = $atm_val.'.zip';
	    $finalimagesdata_array = array();
		$filenamedata_array = array();	
        $foldernamedata_array = array();		
		$ftp_conn_local = OpenComfortFTPLocalCon();
		$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
		
		$footage_type = "Dispute";
		
        $newfolder_path = "Footage_Upload/".$yr."/Dispute/".$mon."/".$dt; 	
		//echo $newfolder_path;
        $newfolder_dt_month = $mon."/".$dt; 		
										
		$newfile_list = ftp_nlist($ftp_conn_local, $newfolder_path);
		//$newfile_list = ftp_nlist($ftp_conn_local, "/Footage_Upload/2024/24Hrs");
		//echo '<pre>';print_r($newfile_list);echo '</pre>';die;
		$cnt = 0;
		if(count($newfile_list)>0){ 
			$count_file = 0;
			for($j=0;$j<count($newfile_list);$j++){
				$ftp_server_path = $newfile_list[$j];
				$split_atm_image = explode("/",$newfile_list[$j]);
				
				if(count($split_atm_image)==6){
					$imagesdata_array = array(); 
					$_atmid_imageval = $split_atm_image[5];
					//echo $_atmid_imageval;
					$check_atmid = substr($_atmid_imageval, -3);
					if($check_atmid!='mp4' && $check_atmid!='dav' && $check_atmid!='avi'){
						$check_footage = "SELECT * FROM `footage_details_available_start_zip` WHERE month='".$mon."' AND dt='".$dt."' AND atmid='".$_atmid_imageval."' AND footage_type='".$footage_type."'";
						$check_footage_res = mysqli_query($con, $check_footage);
						
						if(mysqli_num_rows($check_footage_res)==0){
							array_push($filenamedata_array,$_atmid_imageval);
							$tempnewfolder_path = $newfolder_path."/".$_atmid_imageval;
							$_temp_folder_path = $newfolder_dt_month."/".$_atmid_imageval;
							$local_file_dir = "D:/Footage_Upload/".$yr."/Dispute/".$_temp_folder_path;
							$local_path = "Dispute/".$_temp_folder_path;
							$local_path = str_replace("/","\\\\",$local_path);
							//echo $local_file_dir;
							$local_file_dir = str_replace("/","\\\\",$local_file_dir);
							array_push($foldernamedata_array,$local_file_dir);
							$finalfile_list = ftp_nlist($ftp_conn_local, $tempnewfolder_path);
							//echo '<pre>';print_r($finalfile_list);echo '</pre>';
							if(count($finalfile_list)>0){ 
								for($i=0;$i<count($finalfile_list);$i++){
									$finalsplit_atm_image = explode("/",$finalfile_list[$i]);
								    if(count($finalsplit_atm_image)==7){
										$final_atmid_imageval = $finalsplit_atm_image[6]; 
										$d_drive = $local_file_dir;
										//if(!is_dir($d_drive))
										 //  mkdir($d_drive,0777,true);
										$local_file = $local_file_dir."/".$final_atmid_imageval;
										$server_file = $tempnewfolder_path."/".$final_atmid_imageval;
										array_push($imagesdata_array,$local_file);
									}
								}
								// echo '<pre>';print_r($imagesdata_array);echo '</pre>';
								if(count($imagesdata_array)>0){
									$local_file_array = json_encode($imagesdata_array);
									$remarks = "";
									$set_sql = "INSERT INTO `footage_details_available_start_zip`( `month`, `dt`,`atmid`, `created_at`, `updated_at`, `created_by`, `footage_type`, `ftp_server_path`, `local_path`, `remarks`) VALUES ('".$mon."','".$dt."','".$_atmid_imageval."','".$current_datetime."','".$current_datetime."','24','".$footage_type."','".$ftp_server_path."','".$local_path."','".$remarks."') ";
								//	echo $set_sql;die;
									$set_result = mysqli_query($con,$set_sql); 	
									$cnt = $cnt + 1;
								}
							} 
						}
				    }
				}
			}
			
		}
		CloseCon($con);
		echo $cnt;
		
?>
