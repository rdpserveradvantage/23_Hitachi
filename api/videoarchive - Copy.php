<?php include('db_connection.php'); ?>
<?php 

$custto = $_POST['To_timePicker'];
$custfrom = $_POST['From_timePicker'];
$post_date = $_POST['Search_date'];
$custdate = str_replace('-','_',$post_date);
$custfrom = strstr($custfrom, ':', true);
$from_min = explode(":",$custfrom);
$to_min = explode(":",$custto);
$custto = strstr($custto , ':', true);


$atmid = $_POST['atmid'];
// $path = 'D:\FTP_DATA\share';
$path = 'E:\FTP_DATA\HIKVISION\share';
$limit = 10; 
$adjacents = 3;

$allvideos = [];

 $count = 0 ; 
for ($i=$custfrom; $i <= $custto ; $i++) { 
  //$i = number_format($i); 
    $z = $custfrom;
	$i = strval($i);
	$j = $i;
	if($count>0){
		if($i<10){
			$j = '0'.$j;
		}
		if($z<10){
			$z = '0'.$z;
		}
	}
    $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
    //echo $fromimage_dir;
    $files = scandir($fromimage_dir);
  
    if($files){
		//print_r($files);
        foreach($files as $f=>$v){
			if($v=='.' || $v=='..'){
				$pass = 0;
			}else{
				$files_min = explode("_",$v);
				
				$pass = 1;
				if($i==strval($custto)){ 
				   $filemin = 0;$tomin = 0;
				   if(count($files_min)>0){
					$filemin = $files_min[2];
				   }
				   if(count($to_min)>0){
					$tomin = $to_min[1];
				   }
					if($filemin<=$tomin){ 
						$pass = 1;
					}else{ 
						$pass = 0;
					}
				}
			}
			if($pass==1){
				if(strlen($v) > 5){
					$custvar = $path .'/'.$atmid.'/'.$custdate.'/'.$z .'/'.$v; 
					$newdata = [];
					$newdata['url_link'] = 'http://103.141.218.26:5007/?name='.$custvar;
					$newdata['video_path'] = $fromimage_dir .'/' .$v;
					$newdata['video_name'] = $v;
					$allvideos[] = $newdata;
					$count++;
				}
			}
		}
	}
	$custfrom++ ; 
}

$array = array(['Code'=>200,'res_data'=>$allvideos]);

echo json_encode($array);
?>


