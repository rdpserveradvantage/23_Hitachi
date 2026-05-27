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
$today_date = date('Y-m-d');
$dt = str_replace("-","_",$today_date);
$con = OpenCon();
$footage_type = "24Hrs";
$check_footage = "SELECT * FROM `footage_details_available_new` WHERE dt='".$dt."' AND footage_type='".$footage_type."' AND file_zip_status=0 order by id DESC limit 1";
$check_footage_res = mysqli_query($con, $check_footage);
if(mysqli_num_rows($check_footage_res)>0){
    $_footage_data = mysqli_fetch_assoc($check_footage_res);
	// echo '<pre>';print_r($_footage_data);echo '</pre>';die;
	    date_default_timezone_set("Asia/Calcutta"); 
        $current_datetime = date('Y-m-d H:i:s');
		$local_file_dir = $_footage_data['local_file_dir'];		
		$local_file = $_footage_data['local_file'];		
        $atm_val = $_footage_data['atmid'];		
        $_id = $_footage_data['id'];	
		$fol_mon = $_footage_data['month'];	
		$fol_dt = $_footage_data['dt'];	
		
        $fileName = $atm_val.'.zip';
		$imagesdata_array = array();
		
		$imagesdata_array = json_decode($local_file);
		$insert_data = [];
       // echo '<pre>';print_r($imagesdata_array);echo '</pre>';die;
        if(count($imagesdata_array)>0){
			$fileNameWD = $local_file_dir."/".$fileName;
			if(file_exists($fileNameWD)){
				unlink($fileNameWD);

			}
            $files_to_zip = $imagesdata_array;
           			
			// Get real path for our folder
				$rootPath = realpath($local_file_dir);
                //echo $rootPath;die;
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
//echo $filePath;
						// Add current file to archive
						if (file_exists($filePath) && is_file($filePath))
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
                $set_sql = "INSERT INTO `footage_details_available`( `month`, `dt`,`atmid`, `created_at`, `updated_at`, `created_by`, `footage_type`) VALUES ('".$fol_mon."','".$fol_dt."','".$atm_val."','".$current_datetime."','".$current_datetime."','".$created_by."','".$footage_type."') ";
				$set_result = mysqli_query($con,$set_sql); 	
            //    echo $set_result."_".$set_sql."_";
                $update_qry = "UPDATE `footage_details_available_new` SET file_zip_status=1 where id='".$_id."'";
               $update_result = mysqli_query($con,$update_qry); 
//echo $update_result."_".$update_qry;			   
        }
   
}
CloseCon($con);
//echo $code;	
?>
