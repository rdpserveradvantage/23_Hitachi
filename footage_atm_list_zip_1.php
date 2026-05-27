<?php
include('db_connection.php');

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
$code = 201;
//if(isset($_POST['atmid'])){
	    date_default_timezone_set("Asia/Calcutta"); 
        $current_datetime = date('Y-m-d H:i:s');
        $con = OpenCon();
		$atm_val = "         N2672200  26-05-2023  23.50 TO 00.10";
       // $atm_val = $_POST['atm_val'];
       // $atmimagepath = $_POST['atmid'];
		$atmimagepath = "June/2023_06_07/A2780300 19-05-2023 18.29 to 18.59.mp4";
		$mon_dt_arr = explode("/",$atmimagepath);
		$fol_mon = $mon_dt_arr[0];
		$fol_dt = $mon_dt_arr[1];
		
        $fileName = $atm_val.'.zip';
		$imagesdata_array = array();
		
		$ftp_conn_local = OpenComfortFTPLocalCon();
		$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
		
         $newfolder_path = "Footage_Upload/Rejected/".$atmimagepath; 		
															
		$newfile_list = ftp_nlist($ftp_conn_local, $newfolder_path);
		echo '<pre>';print_r($newfile_list);echo '</pre>';die;
		if(count($newfile_list)>0){ 
			$count_file = 0;
			for($i=0;$i<count($newfile_list);$i++){
				$split_atm_image = explode("/",$newfile_list[$i]);
				if(count($split_atm_image)==5){
					 $_atmid_imageval = $split_atm_image[4];
					// $local_file = "footage_zip/".$_atmid_imageval;
					// $local_file = "E:/CSS_VISIT/footage/".$atm_val;
					 $local_file_dir = "E:/Footage/".$atmimagepath;
					 $local_file_dir = str_replace("/","\\\\",$local_file_dir);
					 $d_drive = $local_file_dir;
					 if(!is_dir($d_drive))
					   mkdir($d_drive,0777,true);
				    // $local_file = $local_file_dir."/".$atm_val; 
					  $local_file = $local_file_dir."/".$_atmid_imageval;
					 $server_file = $newfolder_path."/".$_atmid_imageval;
					 if (ftp_get($ftp_conn_local, $local_file, $server_file, FTP_ASCII)){
						 array_push($imagesdata_array,$local_file);
					 }
					 
				}
			}
		}
		$insert_data = [];
        
        if(count($imagesdata_array)>0){
			$fileNameWD = $local_file_dir."/".$fileName;
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
				$footage_type = "Normal";
                $set_sql = "INSERT INTO `footage_details_available`( `month`, `dt`,`atmid`, `created_at`, `updated_at`, `created_by`, `footage_type`) VALUES ('".$fol_mon."','".$fol_dt."','".$atm_val."','".$current_datetime."','".$current_datetime."','".$created_by."','".$footage_type."') ";
				$set_result = mysqli_query($con,$set_sql); 				
        }
   


/*
            $files = array(); 
            $files = $files_to_zip;
            
            # create new zip opbject
            $zip = new ZipArchive();
            
            # create a temp file & open it
            $tmp_file = tempnam('.','');
            $zip->open($tmp_file, ZipArchive::CREATE);
            
            # loop through each file
            foreach($files as $file){
              // echo $file;die;
                # download file
             //   $download_file = file_get_contents($file);
                $download_file = curl_get_file_contents($file);
                #add it to the zip
                $zip->addFromString(basename($file),$download_file);
            
            }
            
            # close zip
            $zip->close();
            
			*/
		
//$array = array(['code'=>$code]);
//CloseCon($con);
//echo json_encode($array);
echo $code;	
?>
