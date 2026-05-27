<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    //include('config.php');
	function ftpRecursiveFileListing($ftpConnection, $path) {
			static $allFiles = array();
			$contents = ftp_nlist($ftpConnection, $path);

			foreach($contents as $currentFile) {
				// assuming its a folder if there's no dot in the name
				if (strpos($currentFile, '.') === false) {
					ftpRecursiveFileListing($ftpConnection, $currentFile);
				}
				$allFiles[$path][] = substr($currentFile, strlen($path) + 1);
			}
			return $allFiles;
		}
		
		function tempdir() {
			$tempfile=tempnam(sys_get_temp_dir(),'');
			// tempnam creates file on disk
			if (file_exists($tempfile)) { unlink($tempfile); }
			mkdir($tempfile);
			if (is_dir($tempfile)) { return $tempfile; }
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
    ?>
	
	<style>
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		   div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  
			height: 210px; 
			overflow-x: hidden;
			overflow-y: scroll; */
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		th, td {
			white-space: nowrap;
		}
	</style>
         <?php include('top-navbar.php');
		 
		        date_default_timezone_set("Asia/Calcutta"); 
                $current_datetime = date('Y-m-d H:i:s');
                $now   = time();
           	    $today_date = date('Y-m-d');
                $con = OpenCon();	            
				
				//echo '<pre>';print_r($file_list);echo '</pre>';die;
				$footage_type = 'Rejected';
				$check_footage = "SELECT month FROM `footage_details_available_start_zip` WHERE footage_status=1 AND footage_type='".$footage_type."' group by month";
				$check_footage_res = mysqli_query($con, $check_footage);
		 
		 ?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    
                        <!--
						  <div class="card">
						    <div class="card-body">
							    <div class="row">
									<div class="col-lg-4 col-xl-4">
										<button class="btn btn-primary" onclick="get_Detail()">Start Zip</button>
									</div>
								</div>
							</div> -->
							<div class="card-body">
							  <h4 class="card-title">Footage Rejected Details</h4>
							  
							  
								 <div class="row">
								    <?php if(count($check_footage_res)>0){ 
									        while($footage_month = mysqli_fetch_assoc($check_footage_res)) {
												//  $split_month = explode("/",$file_list[$i]);
												$_month_val = $footage_month['month'];
												  
									?>
									<div class="col-lg-3 col-xl-2">
										<a href="footage_list_date_details_rejected_tbl.php?month=<?php echo $_month_val;?>" title="Click ME">  
											<div class="file-man-box">
												<div class="file-img-box">
													<img src="images/shared-folder.png">
												</div>
												<div class="file-man-title" title="Date" >
													<?php echo $_month_val;?>
													
												</div>
											</div>
										</a>
									</div>
												  <?php }}?>
								 </div>
							</div>
						  </div>
						
                    </div>
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        
        <script src="js/off-canvas.js">
        </script>
        <script src="js/hoverable-collapse.js">
        </script>
        <script src="js/misc.js">
        </script>
        <script src="js/settings.js">
        </script>
        <script src="js/todolist.js">
        </script>
        <script src="js/dashboard.js">
        </script>
        <script src="js/site_health.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/data-table2.js"></script>
         <script src="js/select2.js"></script>
       <script>
         onload();
		 function get_Detail(){ 
				
				$("#load").show();
				$.ajax({
							url: "bulkfootageinsert/footage_start_zip_rejected_first.php", 
							type: "POST",
							success: (function (result) { debugger;
								$("#load").hide(); 
								if(result>0){
								alert("Zip started and it is in process so wait...");
								window.location = "footage_list_data_rejected_tbl.php";
								}else{
									alert("No Files found for start zip");
								}
							})
				});
		}
       </script>
    </body>
</html>
