<?php session_start();include('db_connection.php'); ?>
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
			   echo 'parent_dest: '.$parent_dest."</br>".'dest: '.$destination;
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
		   // $i = strval($i);
		    $i = (int)$i; 
		    $j = $i;
			if($i<10){
				$j = '0'.$j;
			}
			if($z<10){
				$z = '0'.$z;
			}
		
			$fromimage_dir = $path .'/'.$atmid.'/'.$custdate.'/'.$j;
			//echo $fromimage_dir;die;
			$files = ftp_nlist($ftp_conn, $fromimage_dir);
			
			//echo '<pre>';print_r($files);echo '</pre>';die;
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
							echo 'src: '.$srcpathftp.'</br>';
							echo 'dtn: '.$destpathftpimg.'</br>';
							echo 'v: '.$v;
							ftp_copy($ftp_conn , $srcpathftp , $destpathftpimg ,$v);
							$dest_path = "D:/FTP_VIDEO".$destpathftpimg."/".$v;
							$dest_path = str_replace("/","\\\\",$dest_path);
							$view_video_filepath = base64_encode($dest_path);
							$view_video_dwnldpath = base64_encode($custvar);
							$video_path['url'] = "video_avi.php?file=".$view_video_filepath."&downloadfile=".$view_video_dwnldpath;
							$video_path['name'] = $v;
							array_push($video_path_arr,$video_path);
							
							//$video_path_arr[] = $video_path;
						}
					}
				}
			}
			$custfrom++ ;
		}
		return $video_path_arr;
	}
	
	
	$con = OpenCon();
	$ftp_conn = OpenFTPCon();
	$ftp_pasv = ftp_pasv($ftp_conn,true);

	$ftp_conn_local = OpenComfortFTPLocalCon();
	$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
	 
		
	//$client = $_GET['client'];
	$client = "Hitachi";
	
	
	$_circle_name = "";
	$_circle_name_array = array();
	$bank = "";$circle = "";
    $atmid = "";
	
	$_atmid = "B1140820";
	$_txn_date = "2022-07-11";
	
	$_txn_from_time="11:32:10";
	$_txn_to_time="12:32:10";
	
	$path = 'AI_Feed';
	$checkimage_dir = $path .'/'.$_atmid.'/'.$_txn_date;
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
	
	$file_url = connectFTP($ftp_conn,$_atmid,$_txn_date,$_txn_from_time,$_txn_to_time);
	CloseCon($con);
	
   echo '<pre>';print_r($file_url);echo '</pre>';die;


?>

