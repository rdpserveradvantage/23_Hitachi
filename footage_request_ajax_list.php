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
		    $i = strval($i);
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
			    				
				foreach($files as $f=>$v){
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
	 
		
	$client = $_GET['client'];
	$banks = explode(",",$_SESSION['bankname']);
    $_bank_name = [];
	for($i=0;$i<count($banks);$i++){
		$_bank = explode("_",$banks[$i]);
		if($_bank[0]==$client){
			array_push($_bank_name,$_bank[1]);
	    }
	} 
	$_bank_name=json_encode($_bank_name);
	$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
	$bankarr=explode(',',$_bank_name);
	$_bank_name = "'" . implode ( "', '", $bankarr )."'";
	
	$_circle_name = "";
	$_circle_name_array = array();
	if($_SESSION['circlename']!=''){
		$assign_circle = explode(",",$_SESSION['circlename']);
		$_circle_name = [];
		for($i=0;$i<count($assign_circle);$i++){
		   $_circle = explode("_",$assign_circle[$i]);
		   array_push($_circle_name,$_circle[1]);
		} 
		//$_circle_name = $_circle_name_array;
		$_circle_name=json_encode($_circle_name);
		$_circle_name=str_replace( array('[',']','"') , ''  , $_circle_name);
		$circlearr=explode(',',$_circle_name);
		$_circle_name = "'" . implode ( "', '", $circlearr )."'";

		$site_circlesql = mysqli_query($con,"select ATMID from site_circle where Circle IN (".$_circle_name.")");	
		while($site_circlesql_result = mysqli_fetch_assoc($site_circlesql)){
				$_circle_name_array[] = $site_circlesql_result['ATMID'];
		}		
	}

   $bank = "";$circle = "";
   $atmid = "";
	if(isset($_GET['bank'])){
	$bank = $_GET['bank'];
	}
	if(isset($_GET['circle'])){
	$circle = $_GET['circle'];
	}
	if(isset($_GET['atmid'])){
	$atmid = $_GET['atmid'];
	}
	$user = $_GET['user'];
	$status = $_GET['Status'];


	if($atmid!=''){
		if($status=='all'){
	        $sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' order by id desc"); 		
		}else{
	        $sql = mysqli_query($con,"select * from footage_request where atmid='".$atmid."' and status='".$status."' order by id desc"); 
		}

	}else{
		if($bank!=''){
			if($circle!=''){
					$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
					while($circlesql_result = mysqli_fetch_assoc($circlesql)){
						$circleatmidarray[] = $circlesql_result['ATMID'];
						
					}
					$circleatmidarray=json_encode($circleatmidarray);
					$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
					$circlearr=explode(',',$circleatmidarray);
					$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
				}else{
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				} 
		  
		}else{
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		//$atmidarray = [];
		while($sitesql_result = mysqli_fetch_assoc($sitesql)){
			//$atmidarray[] = $sitesql_result['ATMID'];
			$_is_atmid = $sitesql_result['ATMID'];
			if(count($_circle_name_array)==0){
				$atmidarray[] = $_is_atmid;
			}else{
				if(in_array($_is_atmid,$_circle_name_array)){
				   $atmidarray[] = $_is_atmid;
				}
			}
			//array_push($atmidarray,(string)$atmid);
		}
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
		if($status=='all'){
			$onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") order by id desc";
		}else{
			$onlinetestsql = "SELECT * FROM footage_request WHERE atmid IN (".$atmidarray.") and status='".$status."' order by id desc";
		}
		$sql = mysqli_query($con,$onlinetestsql);
	}

?>


<div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
							<th>ATMID</th>
							<th>File</th>
                            <th>Card No.</th>
                            <th>Date of Transaction</th>
                            <th>Time of Transaction</th>
							<th>Start Time</th>
							<th>End Time</th>
                            <th>Nature of Transaction</th>
                            <th>Amount of Transaction</th>
                            <th>Transaction No.</th>
                            <th>Complaint No.</th>
                            <th>Complaint Date</th>
                            <th>Claim Date</th> 
                            <!--<th>Action</th> -->
													  
						</tr>
                      </thead>
                      <tbody>
					    <?php 
                        $count = 1 ; 
						  if(mysqli_num_rows($sql)>0){
							  while($sql_result = mysqli_fetch_assoc($sql)){
                                $_status = $sql_result['status'];
								$_id = $sql_result['id'];
								$_atmid = $sql_result['atmid'];
								$_txn_date = $sql_result['date_of_TXN'];
								$_txn_from_time = $sql_result['start_time'];
								$_txn_to_time = $sql_result['end_time'];
								
								if($sql_result['is_checked']==0){
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
									$footage_avail = "No";
									if(count($file_url)>0){
										$footage_avail = "Yes";
									}
									$downloadlink = json_encode($file_url);
									
									$update_query = "UPDATE footage_request SET footage_avail='".$footage_avail."',downlink='".$downloadlink."',is_checked=1 WHERE id='".$_id."'";
									$result=mysqli_query($con,$update_query);
									//echo '<pre>';print_r($file_url);echo '</pre>';
								}else{
									if($sql_result['footage_avail']=='Yes'){
										$file_url_files = $sql_result['downlink'];
										$file_url = json_decode($file_url_files,true);
										//echo '<pre>';print_r($file_url);echo '</pre>';
									}else{
									    $file_url = [];
									}
								}
                        ?>
							   <tr>
							        <td><?php echo $sql_result['atmid'];?></td>
									<td><?php if(count($file_url)>0){
										for($f=0;$f<count($file_url);$f++){ 
									echo '<a href="ffmpeg/bin/'.$file_url[$f]['url'].'" target="_blank">'.$file_url[$f]['name'].'</a></br>';
									    }
										}?></td>
								    <td><?php echo $sql_result['card_no'];?></td>
								    <td><?php echo $sql_result['date_of_TXN'];?></td>
								    <td><?php echo $sql_result['time_of_TXN'];?></td>
									<td><?php echo $sql_result['start_time'];?></td>
								    <td><?php echo $sql_result['end_time'];?></td>
								    <td><?php echo $sql_result['nature_of_TXN'];?></td>
								    <td><?php echo $sql_result['amount_of_TXN'];?></td>
								    <td><?php echo $sql_result['txn_no'];?></td>
								    <td><?php echo $sql_result['complaint_no'];?></td>
								    <td><?php echo $sql_result['complaint_date'];?></td>
								    <td><?php echo $sql_result['claim_date'];?></td>
								   <!-- <td>
									<?php if($_status==0){ if($user=='comfort'){ ?> <a class="btn btn-info" href="footage_request_1_edit.php?id=<?php echo $_id;?>">Process</a> <?php } }?>
									<a class="btn btn-info" href="footage_request_1_details.php?id=<?php echo $_id;?>">View/Update Status</a>
									</td>-->
                  
								</tr>
								
						<?php }
						  }
						?>
                      </tbody>
                    </table>
                  </div>

<?php
CloseCon($con);

?>

