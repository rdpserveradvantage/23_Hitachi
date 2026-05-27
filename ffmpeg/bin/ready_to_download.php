<?php
function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
}



$custto = $_POST['To_timePicker'];
$custfrom = $_POST['From_timePicker'];
$post_date = $_POST['Search_date'];
$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$from_min = explode(":",$custfrom);
$to_min = explode(":",$custto);
$custto = strstr($custto , ':', true);

$video_file = [];
$atmid = $_POST['atmid'];
$path = 'D:\FTP_VIDEO';
$custfrom = (int)$custfrom;
 $custto = (int)$custto;
 $_count = 0 ; 
 
for ($i=$custfrom; $i <= $custto ; $i++) { 

//$i = number_format($i);
	//$i = strval($i);
	$i = (int)$i;
	$j = $i;
	if($_count>0){
	if($i<10){
		$j = '0'.$j;
	}
	}
    $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
	if(is_dir($fromimage_dir)){  

			$files = scandir($fromimage_dir);

			if($files){
				foreach($files as $f=>$v1){
					$v_arr = explode("/",$v1);
					$tot_avi_filepath = count($v_arr);
					if($tot_avi_filepath>0){
						$v = $v_arr[$tot_avi_filepath-1];
					}else{
						$v = $v1;
					}
					if($v=='.' || $v=='..'){
							$pass = 0;
					}else{
						$files_min = explode("_",$v);
						$pass = 1;
						if($i==strval($custto)){ 
							if($files_min[2]<=$to_min[1]){ 
								$pass = 1;
							}else{ 
								$pass = 0;
							}
						}
					}
					if($pass==1){  
				   
						//	foreach($files as $f=>$v){
								if(strlen($v) > 5){ 
								  $_count++;

								  $video_file[] = $fromimage_dir .'/' .$v;         
							  }
						//	}
					}

				}
			 }
  
    }
	$custfrom++;
}

// To Delete previous videos  before next merge
$folder_path = "download_video";
   
$files = glob($folder_path.'/*'); 
foreach($files as $file) {   
    if(is_file($file)) {
        unlink($file); 
    }
}

// End Delete


if(count($video_file)>0){
foreach ($video_file as $key => $value) {
	$source = $value; 
	$filename1 = basename($value);
	$destination = 'download_video/'.$filename1;
	copy($source, $destination) ; 
}


 
$content = "";
$vid=0;


foreach($video_file as $file) {   
    if(is_file($file)) {
        $filename = basename($file);
          $content .= "file " . 'download_video/'.$filename . "\n";   
  ++$vid;
    }
}

    file_put_contents("mydownloadlist.txt", $content);
    if(file_exists('download.mp4'))
    unlink('download.mp4');
    execInBackground('ffmpeg -f concat -i mydownloadlist.txt -c copy download.mp4');  
	
	$array = array(['Code'=>200,'download_link'=>'http://103.141.218.26:8080/ComfortTechnoNew/ffmpeg/bin/download.mp4']);
	}
	else{
		$array = array(['Code'=>201]);
	}
	echo json_encode($array);
	?>

