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
		$date_split = explode('_',$dt);
		$mon_split_val = $date_split[1];
		$month_tbl = (int)$mon_split_val;
		
	    $mon = $month_array[$month_tbl - 1];
		$con = OpenCon();
        $footage_type = "Rejected";
		
			$check_footage = "SELECT * FROM `footage_details_available_start_zip` WHERE month='".$mon."' AND dt='".$dt."' AND footage_type='".$footage_type."' AND footage_status='5'";
			$check_footage_res = mysqli_query($con, $check_footage);
			
			if(mysqli_num_rows($check_footage_res)>0){
				while($footage_startdata = mysqli_fetch_assoc($check_footage_res)){ 
					
					$footage_startdata_id = $footage_startdata['id'];
						
					$set_sql = "UPDATE `footage_details_available_start_zip` SET `footage_status`='4' where id = '".$footage_startdata_id."') ";
					$set_result = mysqli_query($con,$set_sql); 	
					$cnt = $cnt + 1;
					
				} 
			}
				  
		CloseCon($con);
		echo $cnt;
		
?>
