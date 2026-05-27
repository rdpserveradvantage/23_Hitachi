<?php include('../../db_connection.php');
function execInBackground($cmd) { 
    if (substr(php_uname(), 0, 7) == "Windows"){ 
        pclose(popen("start /B ". $cmd, "r"));  
    } 
    else { 
        exec($cmd . " > /dev/null &");   
    } 
}

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

function connectFTP($ftp_conn,$_atmid,$_txn_date,$_txn_from_time,$_txn_to_time){
		$custto = $_txn_to_time;
		$custfrom = $_txn_from_time;

		$custdate = str_replace('-','_',$_txn_date);
		$custfrom = strstr($custfrom, ':', true);
		$from_min = explode(":",$custfrom);
		$to_min = explode(":",$custto);
		$custto = strstr($custto , ':', true);

		$atmid = $_atmid;
	    $path = 'AI_Feed';
		$_count_ftp_file = 0;
		
		$video_path_arr = array();
		for ($i=$custfrom; $i <= $custto ; $i++) { 
		    $z = $custfrom;
			$z = (int)$z;
		    //$i = strval($i);
			$i = (int)$i;
		    $j = $i;
			if($i<10){
				$j = '0'.$j;
			}
			if($z<10){
				$z = '0'.$z;
			}
		
			$fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
			$files = ftp_nlist($ftp_conn, $fromimage_dir);
			
			//echo '<pre>';print_r($files);echo '</pre>';
			if($files){
			    				
				foreach($files as $f=>$v1){
					$v_arr = explode("/",$v1);
					$tot_avi_filepath = count($v_arr);
					if($tot_avi_filepath>0){
						$v = $v_arr[$tot_avi_filepath-1];
					}else{
						$v = $v1;
					}
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
						if($pass==1){
							$_count_ftp_file = $_count_ftp_file + 1;
							$custvar = $path .'/'.$atmid.'/'.$custdate.'/'.$z .'/'.$v; 
							$srcpathftp = $path .'/'.$atmid.'/'.$custdate.'/'.$z;
							$destpathftpimg = '/'.$atmid.'/'.$custdate.'/'.$z;
							$fsize = ftp_size($ftp_conn, $custvar);
                            if ($fsize != -1){
								ftp_copy($ftp_conn , $srcpathftp , $destpathftpimg ,$v);
								$dest_path = "D:/FTP_VIDEO".$destpathftpimg."/".$v;
								$dest_path = str_replace("/","\\\\",$dest_path);
								$view_video_filepath = base64_encode($dest_path);
								$view_video_dwnldpath = base64_encode($custvar);
								$video_path['url'] = "video_avi.php?file=".$view_video_filepath."&downloadfile=".$view_video_dwnldpath;
								$video_path['name'] = $v;
								array_push($video_path_arr,$video_path);
							}
							//$video_path_arr[] = $video_path;
						}
					}
				}
			}
			$custfrom++ ;
		}
		return $video_path_arr;
	}

	$_txn_to_time = $_POST['To_timePicker'];
	$_txn_from_time = $_POST['From_timePicker'];
	$post_date = $_POST['Search_date'];
	$custdate = str_replace('-','_',$post_date);
	/*$custfrom = strstr($custfrom, ':', true);
	$from_min = explode(":",$custfrom);
	$to_min = explode(":",$custto);
	$custto = strstr($custto , ':', true);*/
	$atmid = $_POST['atmid'];

	$con = OpenCon();
	$ftp_conn = OpenFTPCon();
	$ftp_pasv = ftp_pasv($ftp_conn,true);

	$ftp_conn_local = OpenComfortFTPLocalCon();
	$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
	
	$path = 'AI_Feed';
	$checkimage_dir = $path .'/'.$atmid.'/'.$custdate;
	$checkfiles = ftp_nlist($ftp_conn_local, $checkimage_dir);
	if(is_array($checkfiles)){

		if(in_array($j,$checkfiles)){
			$whichftp = 1;
		}else{
			$whichftp = 2;
		}
	}else{
		$whichftp = 2;
	}
	if($whichftp == 1){
		$ftp_conn = $ftp_conn_local;
	}
	
	$file_url = connectFTP($ftp_conn,$atmid,$custdate,$_txn_from_time,$_txn_to_time);
    $footage_avail = "No";
	if(count($file_url)>0){
		$footage_avail = "Yes";
	}

	$array = array(['Code'=>200,'footage_avail'=>$footage_avail]);
	echo json_encode($array);
	?>

