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
	    $this_month = date('m');
		$month_tbl = (int)$this_month;
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
		//echo $newfolder_path;											
		$newfile_list = ftp_nlist($ftp_conn_local, $newfolder_path);
		echo '<pre>';print_r($newfile_list);echo '</pre>';
		if(count($newfile_list)>0){ 
			$count_file = 0;
			for($j=0;$j<count($newfile_list);$j++){
				$split_atm_image = explode("/",$newfile_list[$j]);
				echo '<pre>';print_r($split_atm_image);echo '</pre>';die;
				if(count($split_atm_image)==5){
					$imagesdata_array = array(); 
					$_atmid_imageval = $split_atm_image[4];
					$check_atmid = substr($_atmid_imageval, -3);
					if($check_atmid!='mp4' && $check_atmid!='dav' && $check_atmid!='avi'){
						//echo $_atmid_imageval."_";
					    $check_footage = "SELECT * FROM `footage_details_available` WHERE month='".$mon."' AND dt='".$dt."' AND atmid='".$_atmid_imageval."' AND footage_type='".$footage_type."'";
					    $check_footage_res = mysqli_query($con, $check_footage);
						//echo '<pre>';print_r($check_footage_res);echo '</pre>';die;
					    // echo mysqli_num_rows($check_footage_res);die;
						if(mysqli_num_rows($check_footage_res)==0){
							
							$tempnewfolder_path = $newfolder_path."/".$_atmid_imageval;
							//echo $tempnewfolder_path."_";
							$_temp_folder_path = $newfolder_dt_month."/".$_atmid_imageval;
							$local_file_dir = "E:/Footage/Dispute/".$_temp_folder_path;
							$local_file_dir = str_replace("/","\\\\",$local_file_dir);
							
							$finalfile_list = ftp_nlist($ftp_conn_local, $tempnewfolder_path);
							 
							// $local_file = "footage_zip/".$_atmid_imageval;
							// $local_file = "E:/CSS_VISIT/footage/".$atm_val;
							if(count($finalfile_list)>0){ 
							    
							   // echo '<pre>';print_r($finalfile_list);echo '</pre>';die;
								for($i=0;$i<count($finalfile_list);$i++){
									$finalsplit_atm_image = explode("/",$finalfile_list[$i]);
								   // echo '<pre>';print_r($finalsplit_atm_image);echo '</pre>';die;
									if(count($finalsplit_atm_image)==6){
										array_push($filenamedata_array,$_atmid_imageval);
										array_push($foldernamedata_array,$local_file_dir);
										$final_atmid_imageval = $finalsplit_atm_image[5]; 
																		
										$d_drive = $local_file_dir;
										if(!is_dir($d_drive))
										   mkdir($d_drive,0777,true);
										// $local_file = $local_file_dir."/".$atm_val; 
										$local_file = $local_file_dir."/".$final_atmid_imageval;
										
										$server_file = $tempnewfolder_path."/".$final_atmid_imageval;
										//echo 'local : '.$local_file." & server : ".$server_file;die;
										
										if (ftp_get($ftp_conn_local, $local_file, $server_file, FTP_ASCII)){
											 array_push($imagesdata_array,$local_file);
										}
									}
								}
								array_push($finalimagesdata_array,$imagesdata_array);
							} 
						}
				    }
				}
			}
			//echo '<pre>';print_r($foldernamedata_array);echo '</pre>';
			//echo '<pre>';print_r($filenamedata_array);echo '</pre>';
			//echo '<pre>';print_r($finalimagesdata_array);echo '</pre>';die;
		}
		$insert_data = [];
        if(count($finalimagesdata_array)>0){
			foreach($finalimagesdata_array as $_key => $imagesdata_array){
				if(count($imagesdata_array)>0){
					$fol_name = $foldernamedata_array[$_key];
					$fil_name = $filenamedata_array[$_key];
					//$fileNameWD = $local_file_dir."/".$fileName;
					$fileNameWD = $fol_name."/".$fil_name.".zip";
					//echo $fileNameWD;die;
					if(file_exists($fileNameWD)){
						unlink($fileNameWD);

					}
					$files_to_zip = $imagesdata_array;
				   /* $result = create_zip($files_to_zip,$fileName);
					if($result){
						$code = 200;
					} */
					# send the file to the browser as a download
					/*if($result){
						header('Content-disposition: attachment; filename=house-keeping.zip');
						header('Content-type: application/zip');
						ob_clean();
						flush();
						readfile($tmp_file);
						unlink($tmp_file);
					} */
					
					
					// Get real path for our folder
						$rootPath = realpath($local_file_dir);

						// Initialize archive object
						$zip = new ZipArchive();
						$zip->open($fileNameWD, ZipArchive::CREATE | ZipArchive::OVERWRITE);

						// Initialize empty "delete list"
						$filesToDelete = array();

						// Create recursive directory iterator
						/** @var SplFileInfo[] $files */
						$files = new RecursiveIteratorIterator(
							new RecursiveDirectoryIterator($rootPath),
							RecursiveIteratorIterator::LEAVES_ONLY
						);

						foreach ($files as $name => $file)
						{
							// Skip directories (they would be added automatically)
							if (!$file->isDir())
							{
								// Get real and relative path for current file
								$filePath = $file->getRealPath();
								$relativePath = substr($filePath, strlen($rootPath) + 1);

								// Add current file to archive
								$zip->addFile($filePath, $relativePath);

								// Add current file to "delete list"
								// delete it later cause ZipArchive create archive only after calling close function and ZipArchive lock files until archive created)
								if ($file->getFilename() != 'important.txt')
								{
									$filesToDelete[] = $filePath;
								}
							}
						}

						// Zip archive will be created only after closing object
						$zip->close();

						// Delete all files from "delete list"
						foreach ($filesToDelete as $file)
						{
							//unlink($file);
						}
						$code = 200;	
						$created_by = 24;
						
						$set_sql = "INSERT INTO `footage_details_available`( `month`, `dt`,`atmid`, `created_at`, `updated_at`, `created_by`, `footage_type`) VALUES ('".$mon."','".$dt."','".$fil_name."','".$current_datetime."','".$current_datetime."','".$created_by."','".$footage_type."') ";
						$set_result = mysqli_query($con,$set_sql); 				
				}
			}
		}
 
       // echo $code;	
?>
