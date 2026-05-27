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
	
				$ftp_conn_local = OpenComfortFTPLocalCon();
				$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
								 
				$month = $_GET['month'];	
                $folder_path = "Footage_Upload/Dispute/".$month; 				
				$file_list = ftp_nlist($ftp_conn_local, $folder_path);
				//echo '<pre>';print_r($file_list);echo '</pre>';die;
		 
		 ?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    

						  <div class="card">
							<div class="card-body">
							  <h4 class="card-title">Footage Dispute Details > <?php echo $month;?> </h4>
							  
							  
								 <div class="row">
								    <?php if(count($file_list)>0){ 
									          for($i=0;$i<count($file_list);$i++){
												  $split_atm = explode("/",$file_list[$i]);
												  if(count($split_atm)==4){
												     $_atmid_val = $split_atm[3];
													 $month_atm = $month."/".$_atmid_val;
									?>
									<div class="col-lg-3 col-xl-2">
										<a href="footage_list_atm_details_dispute.php?atmpath=<?php echo $month_atm;?>" title="Click ME">  
											<div class="file-man-box">
												<div class="file-img-box">
													<img src="images/shared-folder.png">
												</div>
												<div class="file-man-title" title="Date" >
													<?php echo $_atmid_val;?>
													
												</div>
											</div>
										</a>
									</div>
												  <?php }}}?>
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
       </script>
    </body>
</html>
