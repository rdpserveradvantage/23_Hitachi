<?php
function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
}


$video_file[] = $_POST['file'];
// To Delete previous videos  before next merge
$folder_path = "download_video";
   
$files = glob($folder_path.'/*'); 
foreach($files as $file) {   
    if(is_file($file)) {
        unlink($file); 
    }
}

// End Delete



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

    unlink('download.mp4');
    execInBackground('ffmpeg -f concat -i mydownloadlistlist.txt -c copy download.mp4');  
	
	$array = array(['Code'=>200,'download_link'=>'http://103.141.218.26:8080/ComfortTechnoNew/api/download.mp4']);
	echo json_encode($array);
	?>

