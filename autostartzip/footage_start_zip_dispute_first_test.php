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
		//$today_date = '2023-06-12';
	    $this_month = date('m');
		$month_tbl = (int)$this_month;
	   // $month_tbl = 6;
	    $mon = $month_array[$month_tbl - 1];
		//echo $mon;die;
	    $dt = str_replace("-","_",$today_date);
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
		//$dt = "2023_06_02";
		$footage_type = "Dispute";
		// ."/E2188910 27-05-2023 10.11.09 to 10.41.09"
        $newfolder_path = "Footage_Upload/Dispute/".$mon."/".$dt; 	
        $newfolder_dt_month = $mon."/".$dt; 		
		//echo $newfolder_path;			die;								
		$newfile_list = ftp_nlist($ftp_conn_local, $newfolder_path);
		//echo '<pre>';print_r($newfile_list);echo '</pre>';die;
		$cnt = 0;
		if(count($newfile_list)>0){ 
			$count_file = 0;
			for($j=0;$j<count($newfile_list);$j++){
				$split_atm_image = explode("/",$newfile_list[$j]);
				//echo '<pre>';print_r($split_atm_image);echo '</pre>';die;
				if(count($split_atm_image)==5){
					$imagesdata_array = array(); 
					$_atmid_imageval = $split_atm_image[4];
					$check_atmid = substr($_atmid_imageval, -3);
					if($check_atmid!='mp4' && $check_atmid!='dav' && $check_atmid!='avi'){
					    $check_footage = "SELECT * FROM `footage_details_available_new` WHERE month='".$mon."' AND dt='".$dt."' AND atmid='".$_atmid_imageval."' AND footage_type='".$footage_type."'";
					    $check_footage_res = mysqli_query($con, $check_footage);
					
				    }else{
						echo $_atmid_imageval." ___ ";
					}
				}
			}
			//echo '<pre>';print_r($foldernamedata_array);echo '</pre>';
			//echo '<pre>';print_r($filenamedata_array);echo '</pre>';
			//echo '<pre>';print_r($finalimagesdata_array);echo '</pre>';die;
		}
		//echo $cnt;
		CloseCon($con);
?>
