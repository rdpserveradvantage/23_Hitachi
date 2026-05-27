<?php   include('db_connection.php');
        $con = OpenCon();
			    function ftp_copy($pathftp , $pathftpimg ,$img){ 
					   // $temp_fol = tempdir();
					   $dir = __DIR__.'/temp/';
						# See if directory exists, create if not
						if(!is_dir($dir))
							mkdir($dir,0755,true);
						$d_drive = "E:\FTP_VIDEO";
						if(!is_dir($d_drive))
						   mkdir($d_drive,0755,true);
					   $parent_dest = $d_drive.$pathftpimg;
					   $destination = $d_drive.$pathftpimg.'/'.$img;
					   $src = $pathftp;
						if (!is_dir($parent_dest)) {
						  mkdir(dirname($destination ), 0777, true);
						}
						
						if( !copy($src, $destination) ) { 
							return false; 
						} 
						else { 
							unlink($pathftp) ;
						} 
							
						return true ; 
				}
            if (isset($_POST['submit']))
            {
				$_id = $_POST['footage_id']; 
				$src_file = $_FILES['srcfile']['name'];
				$new_src_file = $_FILES['srcfile']['tmp_name'];
				$ext = pathinfo($src_file, PATHINFO_EXTENSION);
				$post_date = $_POST['S_date']; 
				$p_d = explode("/",$post_date);
				$custfrom = $_POST['From_timePicker'];
                $custdate = $p_d[2]."_".$p_d[0]."_".$p_d[1]; 
				
				$from_hour = explode(":",$custfrom);
				$from_min = str_replace(':','_',$custfrom);
				$folderdate = $p_d[2]."-".$p_d[0]."-".$p_d[1];
				$new_src_name = $folderdate."_".$from_min.".".$ext;
				
				$atm = $_POST['atmid'];
				$target_dir = "uploads/";
				$destpathftpimgfolder = '/'.$atm.'/'.$custdate.'/'.$from_hour[0];
			    $destpathftpimg = '/'.$atm.'/'.$custdate.'/'.$new_src_name;
               
				$target_file = $target_dir . $new_src_name; 
				/*
				 if (move_uploaded_file($_FILES["srcfile"]["tmp_name"],$target_file)) {
					 echo 'Uploaded';
					$dest_path = "E:/FTP_VIDEO".$destpathftpimg;
					$dest_path = str_replace("/","\\\\",$dest_path);
					$view_video_filepath = base64_encode($dest_path);
					
				 }else{
					 echo 'No';
				 }
				 && ($_FILES["srcfile"]["size"] < 20000)
				*/
				
				//$allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma","avi");
				$allowedExts = array("mp4", "avi");
				$extension = pathinfo($_FILES['srcfile']['name'], PATHINFO_EXTENSION);
				//echo $_FILES["srcfile"]["size"];die;
                /* 
				if ((($_FILES["srcfile"]["type"] == "video/mp4")
				|| ($_FILES["srcfile"]["type"] == "video/avi")
				|| ($_FILES["srcfile"]["type"] == "audio/mp3")
				|| ($_FILES["srcfile"]["type"] == "audio/wma")
				|| ($_FILES["srcfile"]["type"] == "image/pjpeg")
				|| ($_FILES["srcfile"]["type"] == "image/gif")
				|| ($_FILES["srcfile"]["type"] == "image/jpeg")) */
				
				if ((($_FILES["srcfile"]["type"] == "video/mp4")
				|| ($_FILES["srcfile"]["type"] == "video/avi")
				)

				&& in_array($extension, $allowedExts))

				  {
				  if ($_FILES["srcfile"]["error"] > 0)
					{
					echo "Return Code: " . $_FILES["srcfile"]["error"] . "<br />";
					}
				  else
					{
					echo "Upload: " . $_FILES["srcfile"]["name"] . "<br />";
					echo "Type: " . $_FILES["srcfile"]["type"] . "<br />";
					echo "Size: " . ($_FILES["srcfile"]["size"] / 1024) . " Kb<br />";
					echo "Temp file: " . $_FILES["srcfile"]["tmp_name"] . "<br />";

					if (file_exists("uploads/" . $_FILES["srcfile"]["name"]))
					{
					  echo $_FILES["srcfile"]["name"] . " already exists. ";
					}
					else
					  {
						ftp_copy($_FILES["srcfile"]["tmp_name"] , $destpathftpimgfolder ,$new_src_name);
						  //if(move_uploaded_file($_FILES["srcfile"]["tmp_name"],$target_file)){
							  
						  //}
						 // echo "Stored in: " . "uploads/" . $_FILES["srcfile"]["name"];
						$video_path_arr = array();
						$dest_path = "E:/FTP_VIDEO".$destpathftpimgfolder."/".$new_src_name;
						$dest_path = str_replace("/","\\\\",$dest_path);
						$view_video_filepath = base64_encode($dest_path);
						//$view_video_dwnldpath = base64_encode($custvar);
						$video_path['url'] = "video_avi_dwnld.php?file=".$view_video_filepath;
						$video_path['name'] = $new_src_name;
						array_push($video_path_arr,$video_path); 
						$footage_avail = "No";
						if(count($video_path_arr)>0){
							$footage_avail = "Yes";
						}
						$downloadlink = json_encode($video_path_arr);
						
						$update_query = "UPDATE footage_request SET footage_avail='".$footage_avail."',downlink='".$downloadlink."',is_checked=1 WHERE id='".$_id."'";
						$result=mysqli_query($con,$update_query);
					  }
					}
				  }
				else
				  {
				  echo "Invalid file";
				  }
				
			
				
            }
			
CloseCon($con);

?>
       