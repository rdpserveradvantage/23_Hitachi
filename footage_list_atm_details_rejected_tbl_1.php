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
				$d_drive = "E:\CSS_VISIT\footage";
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
	<style>
.tooltip {
  position: relative;
  display: inline-block;
  border-bottom: 1px dotted black;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;

  /* Position the tooltip */
  position: absolute;
  z-index: 1;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
}
</style>
         <?php include('top-navbar.php');
		 
		        date_default_timezone_set("Asia/Calcutta"); 
                $current_datetime = date('Y-m-d H:i:s');
                $now   = time();
           	    $today_date = date('Y-m-d');
				
				$atmpath = $_GET['atmpath'];	
				$atmpath_split = explode("/",$atmpath);
				$mon = $atmpath_split[0];
				$dt = $atmpath_split[1];
				
	            $con = OpenCon();
				 
				$getimagesql = "SELECT * FROM `footage_details_available_start_zip` WHERE footage_status=1 AND month='".$mon."' AND dt='".$dt."' AND footage_type='Rejected'"; 
				//echo $getimagesql;
				$getimagesdata = mysqli_query($con,$getimagesql);
				$check_arr = array();
				//echo mysqli_num_rows($getimagesdata);die;

				
				//echo '<pre>';print_r($check_arr);echo '</pre>';die;
				 mysqli_close($con);
				
				
		        
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
							    <div class="row">
									<div class="col-lg-4 col-xl-4">
										<input type="hidden" id="start_zip_date" value="<?php echo $dt;?>">
										<button class="btn btn-primary" onclick="start_Zip()">Start Zip</button>
									</div>
								</div>
							</div>
							<div class="card-body">
							  <h4 class="card-title">Footage Rejected Details > <?php echo $mon; ?> > <?php echo $dt; ?></h4>
							  
							  
								 <div class="row">
								    <?php if(mysqli_num_rows($getimagesdata)>0){
									          while($foot_data = mysqli_fetch_assoc($getimagesdata)){
												  
												  
													 $foot_empty = 0; 
													 $foot_id = 0;
													 $_fol_month = $foot_data['month'];
													 $_fol_dat = $foot_data['dt'];
												     $_atmid_val = $foot_data['atmid'];
													 $_atmimage = $_atmid_val;
													 $file = $_fol_month."/".$_fol_dat."/".$_atmid_val."/".$_atmid_val.".zip";
													 $file = urlencode($file);
													 $path = "E:/Footage_Upload/Rejected/$file";
													 $path = str_replace("/","\\\\",$path);
													 
													$foot_id = 1;
									?>
									<div class="col-lg-3 col-xl-2" style="border: 1px solid;padding:8px;">
										<!--<a href="footage_list_atm_image_details_Rejected.php?atmimage=<?php echo $_atmimage;?>" title="Click ME">  -->
											<div class="file-man-box">
												<div class="file-img-box">
													<img src="images/shared-folder.png">
												</div>
												<div class="file-man-title" title="Date" >
													<?php echo $_atmid_val;?>
													
												</div>
											</div>
										<!--</a>-->
										<?php if($foot_id==0){  
										        if($foot_empty==1){ ?>
												<div class="row">
													<div class="col-lg-12 col-xl-12">
														<h5 style="padding:6px;">No Files Found</h5>
													</div>
												</div>
										<?php	}else{
										
										?>
										<div class="row">
											<div class="col-lg-2 col-xl-2">
											    <button class="btn btn-primary" onclick="get_Detail('<?php echo $_atmimage;?>','<?php echo $_atmid_val;?>')">Start Zip</button>
											</div>
										</div>
                                        <div class="row">										
											<div class="col-md-6 col-xl-6">
											    <input type="hidden" id="<?php echo "path_".$_atmid_val;?>" value="<?php echo $path;?>">
											    <a class="btn btn-danger" id="<?php echo $_atmid_val;?>" style="display:none;" href="" title="Click To Download"><i class="fa fa-download"></i></a>
											</div>
											<div class="col-md-6 col-xl-6 ">
											
											    <button class="btn btn-info" id="<?php echo "copy_".$_atmid_val;?>" style="display:none;" onclick="myFunction('<?php echo 'https://103.141.218.26/ComfortTechnoNew/download_footage.php?path='.$path;?>')" title="Click To Copy Download URL"><i class="fa fa-copy"></i></button>
											</div>
                                        </div>	
                                        <?php } }else{ ?>	
                                         <div class="row">										
											<div class="col-md-6 col-xl-6">
											   <a class="btn btn-danger" href="<?php echo 'download_footage.php?path='.$path;?>" title="Click To Download"><i class="fa fa-download"></i></a>
											</div>
											<div class="col-md-6 col-xl-6 ">
											<!-- <a  href="<?php echo $path;?>" download> -->
											    <button class="btn btn-info" onclick="myFunction('<?php echo 'https://103.141.218.26/ComfortTechnoNew/download_footage.php?path='.$path;?>')" title="Click To Copy Download URL"><i class="fa fa-copy"></i></button>
											</div>
                                        </div>	 
                                        <?php } ?>										
									</div>
												  <?php }}?>
								 </div>
							</div>
						  </div>
						
                    </div>
                    <?php //CloseCon($con);
					include('footer.php');?>
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
		function checkStartZipProcess(){
			var dt = $('#start_zip_date').val();
			var footage_type = 'Rejected';
			$.ajax({
						url: "bulkfootageinsert/check_start_zip_processing.php", 
						type: "POST",
						data: {dt:dt,footage_type:footage_type},
						success: (function (result) { debugger;
							//$("#load").hide(); 
							var txt = result + " left remaining out of 25";
							if(result>0){
								//alert("Zip started and it is in process so wait..."+ txt);
								checkStartZipProcess();
							}else{
								$("#load").hide(); 
								location.reload();
								//window.location = "footage_list_atm_details_dispute_tbl.php";
							}
						})
			});
		}
		function start_Zip(){ 
				var dt = $('#start_zip_date').val();
				$("#load").show();
				$.ajax({
							url: "bulkfootageinsert/footage_start_zip_rejected_first_1.php", 
							type: "POST",
							data: {dt:dt},
							success: (function (result) { debugger;
								//$("#load").hide(); 
								if(result>0){
									checkStartZipProcess();
								}else{
									alert("No Files found for start zip");
								}
							})
				});
		}
		function get_Detail(atmid,atm){ 
				var atm_id =  atmid;  
				var atm_val = atm;
				$("#load").show();
				$.ajax({
							url: "footage_atm_list_zip_rejected.php", 
							type: "POST",
							data: {atmid:atm_id,atm_val:atm_val},
							success: (function (result) { debugger;
								$("#load").hide(); 
								if(result==200){
									var path_href = $('#path_'+atm).val();
									path_href = 'download_footage.php?path='+path_href;
									$('#'+atm).attr('href',path_href);
									$('#'+atm).css('display','block');
									$('#copy_'+atm).css('display','block');
								}else{
									
								}
							})
				});
		}
		
		function myFunction(copyText) {
		  // Get the text field
		  // var copyText = document.getElementById(atmid);

		  // Select the text field
		  // copyText.select();
		  // copyText.setSelectionRange(0, 99999); // For mobile devices

		  // Copy the text inside the text field
		  navigator.clipboard.writeText(copyText);

		  // Alert the copied text
		  alert("Copied the text: " + copyText);
		}
       </script>
    </body>
</html>
