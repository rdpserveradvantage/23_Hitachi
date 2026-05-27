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
if(isset($_POST['S_date'])){
    if($_POST['From_timePicker']){
        $S_date = $_POST['S_date'];
		$date = strtotime($S_date);
		$date = date("Y-m-d",$date);
		$From_timePicker = $_POST['From_timePicker'];
		$_time = explode(":",$From_timePicker);
		$time = $_time[0];
        $fileName = 'house-keeping.zip';
		
		$con = OpenCon();
        $getimagesql = "SELECT File_loc,ATMCode FROM `ai_alerts_alive` WHERE CAST(receivedtime AS DATE)='".$date."' AND DATE_FORMAT(receivedtime, '%k')='".$time."' GROUP BY ATMCode"; 
        $getimagesdata = mysqli_query($con,$getimagesql);
        $imagesdata_array = array();
		$get_dwnld_zip_excel = mysqli_query($con,"SELECT * from download_zip_excel");
		if(mysqli_num_rows($get_dwnld_zip_excel)>0){
			mysqli_query($con,"TRUNCATE TABLE download_zip_excel");
		}
		$insert_data = [];
        if(mysqli_num_rows($getimagesdata)>0){
            while($getimages_result = mysqli_fetch_assoc($getimagesdata)){
				$image_file = $getimages_result['File_loc'];
				$atm_code = $getimages_result['ATMCode'];
				//$src = 'data: jpeg;base64,'.$image_file; 
				$img = $image_file;
				$img = str_replace('data:image/png;base64,', '', $img);
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$file = "newzip_images/" . $atm_code . '.png';
				$success = file_put_contents($file, $data);
				array_push($imagesdata_array,$file);
				$status = "SUCCESS";
				$set_sql = "INSERT INTO `download_zip_excel`( `atmid`, `status`) VALUES ('".$atm_code."','".$status."') ";
				$set_result = mysqli_query($con,$set_sql); 
            }
        }
        if(count($imagesdata_array)>0){
			if(file_exists('house-keeping.zip')){
				unlink('house-keeping.zip');

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
				$rootPath = realpath('newzip_images');

				// Initialize archive object
				$zip = new ZipArchive();
				$zip->open($fileName, ZipArchive::CREATE | ZipArchive::OVERWRITE);

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
					unlink($file);
				}
				$code = 200;		  
        }
    }
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
CloseCon($con);
//echo json_encode($array);
echo $code;	
?>
