<?php include('db_connection.php'); ?>
<?php 

		function ftp_copy($conn_distant , $pathftp , $pathftpimg ,$img){ 
		       // $temp_fol = tempdir();
			   $dir = __DIR__.'/temp/';
				# See if directory exists, create if not
				if(!is_dir($dir))
					mkdir($dir,0755,true);
				$d_drive = "D:\FTP_VIDEO";
				if(!is_dir($d_drive))
				   mkdir($d_drive,0755,true);
			   $parent_dest = $d_drive.$pathftpimg;
			   $destination = $d_drive.$pathftpimg.'/'.$img;
			   if(ftp_get($conn_distant, $dir.'/'.$img, $pathftp.'/'.$img ,FTP_BINARY)){ 
			        $src = $dir.'/'.$img;
					if (!is_dir($parent_dest)) {
					  mkdir(dirname($destination ), 0777, true);
					}
					
					if( !copy($src, $destination) ) { 
						return false; 
					} 
					else { 
						unlink($dir.'/'.$img) ;
					} 
					/*if(ftp_put($conn_distant, $pathftpimg.'/'.$img ,TEMPFOLDER.$img , FTP_BINARY)){ 
							unlink(TEMPFOLDER.$img) ;                                              
					} else{                                
							return false; 
						}  */

				}else{ 
						return false ; 
				} 
				return true ; 
		}

   
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
 $path = './AI_Feed';
 
 
$ftp_conn_local = OpenComfortFTPLocalCon();
$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
$checkimage_dir = $path .'/'.$atmid.'/'.$custdate;
$checkfiles = ftp_nlist($ftp_conn_local, $checkimage_dir);


 
$ftp_conn_1 = OpenFTPCon();
//$ftp_conn_1 = OpenFTPCon();
$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);

 
$limit = 10; 
$adjacents = 3;

$allvideos = [];
$files = '';
 $count = 0 ; 
 $custfrom = (int)$custfrom;
 $custto = (int)$custto;
 
  $fromimage_dir = $path .'/'.$atmid.'/'.$custdate;
  $files = ftp_nlist($ftp_conn_1, $fromimage_dir);
 // $files = $fromimage_dir;
 
 /*
 $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/08';
		
		$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
  
 for ($i=$custfrom; $i <= $custto ; $i++) {
	    $z = $custfrom;
		//$i = number_format($i); 
		$i = strval($i);
		$j = $i;
		//if($count>0){
		if($i<10){
			$j = '0'.$j;
		}
		if($z<10){
			$z = '0'.$z;
		}
	    $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
		
		$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
		$i = $custto + 1;
 } 
*/

/*
for ($i=$custfrom; $i <= $custto ; $i++) { 
  //$i = number_format($i); 
     $z = $custfrom;
	//$i = number_format($i); 
	$i = strval($i);
	$j = $i;
	if($i<10){
		$j = '0'.$j;
	}
	if($z<10){
		$z = '0'.$z;
	}
    $fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
    if(is_array($checkfiles)){
		if(in_array($j,$checkfiles)){
			$files = ftp_nlist($ftp_conn_local, $fromimage_dir);
			$whichftp = 1;
		}else{
			$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
			$whichftp = 2;
		}
	}else{
		$files = ftp_nlist($ftp_conn_1, $fromimage_dir);
		$whichftp = 2;
	}
  
    if($files){
		//print_r($files);
        foreach($files as $f=>$v){
			if($v=='.' || $v=='..'){
				$pass = 0;
			}else{
				if($v!='desktop.ini'){
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
			}
			if($pass==1){
				if(strlen($v) > 5){
					$custvar = $path .'/'.$atmid.'/'.$custdate.'/'.$z .'/'.$v; 
					$srcpathftp = $path .'/'.$atmid.'/'.$custdate.'/'.$z;
					$destpathftpimg = '/'.$atmid.'/'.$custdate.'/'.$z;
					if($whichftp == 1){
						ftp_copy($ftp_conn_local , $srcpathftp , $destpathftpimg ,$v);
					}else{
					    ftp_copy($ftp_conn_1 , $srcpathftp , $destpathftpimg ,$v);
					}
					$dest_path = "D:/FTP_VIDEO".$destpathftpimg."/".$v;
					$dest_path = str_replace("/","\\\\",$dest_path);
					$newdata = [];
					$newdata['url_link'] = 'http://103.141.218.26:5007/?name='.$dest_path;
					//$newdata['url_link'] = 'http://103.141.218.26:5007/?name='.$custvar;
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
*/

$array = array(['Code'=>200,'res_data'=>$allvideos,'vid'=>$files]);

echo json_encode($array);
?>


