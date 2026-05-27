<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	<link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="clockpicker/clockpicker.css" rel="stylesheet">
	
	<style>
    .table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		  #accordion div.card-body {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  */
			height: 210px;
			overflow-x: hidden;
			overflow-y: scroll;
			text-align:justify;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
          <div class="center">
              
               <h3 class="page-title" >
               Footage Request Video Upload
            </h3>
          </div>



            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav> -->
          </div>
        
          <div class="row">
		    <div class="col-12 grid-margin">
                         <?php //include('filters/sitehealth_filter.php');
						    //include('filters/add_footagerequest_filter.php');
						 ?>
			</div>   
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                                   
              <div class="card-body">
                  <h4 class="card-title">Footage Request Video Upload</h4>
				  <form id="form" method="POST" action="footage_request_video_upload.php" enctype="multipart/form-data">
                                      <div class="row">

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">AtmID : </label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" readonly required name="atmid" id="atmid" value="" />
												  </div>
												</div>
											  </div>
											  
											   <div class="col-md-4"> 
												   <div class="form-group row">
														<label class="col-sm-4 col-form-label">Date :</label>
														<div class="col-sm-9">
															<div class="input-group">
																<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="S_date" name="S_date" value="<?php if(isset($_POST['S_date'])){ echo $_POST['S_date']; }?>" required>
																<div class="input-group-append">
																	<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
																</div>
															</div>
														</div>
													</div>
											    </div>
                 
											<div class="col-md-4"> 
												<div class="form-group row">
												<label class="col-sm-4 col-form-label">Time :</label>
												
												<div class="col-sm-9">
													<div class="pull-center clearfix" style="margin-bottom:10px;">
														<input class="form-control pull-left" id="time-input-hh-mm-ss" name="From_timePicker" value="" placeholder="HH:mm:ss" style="width:100px;margin-right:20px;">
													</div>
												</div>	
											    </div>
											</div>
											  
										</div>
										<div class="row">
											<div class="form-group">
											    <label class="col-sm-4 col-form-label">Upload Video File :</label>
												<input type="file" name="srcfile" />
											</div>
                                        </div>    
                                        <div class="form-group">
											<input type="submit" name="submit" value="Upload File to FTP Server" class="btn btn-warning"/>
										</div>
                    <!--<button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>-->
                    <!--<button class="btn btn-light">Cancel</button>-->
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
		
		<?php 
            if (isset($_POST['submit']))
            {
				//echo 'Data uploading';die;
				$src_file = $_FILES['srcfile']['name'];
				$new_src_file = $_FILES['srcfile']['tmp_name'];
				$ext = pathinfo($src_file, PATHINFO_EXTENSION);
				$post_date = $_POST['S_date']; 
				$p_d = explode("/",$post_date);
				$custfrom = $_POST['From_timePicker'];
                $custdate = $p_d[2]."_".$p_d[0]."_".$p_d[1]; 
				//$atm_folderdate = str_replace('-','_',$post_date); 
				//$custfrom = strstr($custfrom, ':', true);
				$from_hour = explode(":",$custfrom);
				$from_min = str_replace(':','_',$custfrom);
				$folderdate = $p_d[2]."-".$p_d[0]."-".$p_d[1];
				$new_src_name = $folderdate."_".$from_min.".".$ext;
				//echo $from_min;die;
				//echo '<pre>';print_r($from_min);echo '</pre>';die;
				$atm = $_POST['atmid'];
				$path = './AI_Feed';
				$ftp_conn_1 = OpenFTPCon();
				$ftp_pasv_1 = ftp_pasv($ftp_conn_1,true);
				//echo ftp_pwd($ftp_conn_1);
				/*
				if (ftp_rmdir($ftp_conn_1, '2022_09_30'))
				{
				  echo "Directory '2022_09_30' deleted";
				} */
				$atmfile_list_share = ftp_nlist($ftp_conn_1, './AI_Feed');
				//$checkatm = ftp_nlist($ftp_conn_1, './AI_Feed');
				//$checkatm = ftp_nlist($ftp_conn_1, $path);
				//echo '<pre>';print_r($checkatm);echo '</pre>';echo $new_src_name;die;
				//echo $custdate;
				$checkatm = array();
				if(count($atmfile_list_share)>0){
					for($z=0;$z<count($atmfile_list_share);$z++){
						$filepath_explode = explode('/',$atmfile_list_share[$z]);
						if(count($filepath_explode)==3){
							if($filepath_explode[2]!='desktop.ini'){
							   array_push($checkatm,$filepath_explode[2]);
							}
						}
					}
				}
				//echo '<pre>';print_r($checkatm);echo '</pre>';
				if(is_array($checkatm)){
					if(in_array($atm,$checkatm)){
						$datepath = $path.'/'.$atm;
						//echo $datepath;die;
						$checkatmdate = ftp_nlist($ftp_conn_1, $datepath);
						//echo '<pre>';print_r($checkatmdate);echo '</pre>';die;
						$checkatmdatearr = array();
						if(count($checkatmdate)>0){
							for($z=0;$z<count($checkatmdate);$z++){
								$datepath_explode = explode('/',$checkatmdate[$z]);
								if(count($datepath_explode)==4){
									if($datepath_explode[3]!='desktop.ini'){
									   array_push($checkatmdatearr,$datepath_explode[3]);
									}
								}
							}
						}
						echo '<pre>';print_r($checkatmdatearr);echo '</pre>';die;
						if(is_array($checkatmdatearr)){
					        if(in_array($custdate,$checkatmdatearr)){
							    echo 'Folder Exist';
						    }else{
							    $dir = $path.'/'.$atm.'/'.$custdate;
								if (ftp_mkdir($ftp_conn_1, $dir)){
								echo "Successfully created $dir";
								  }
								else
								  {
								  echo "Error while creating $dir";
								  }
						   }
						}else{
							$dir = $atm;
							if (ftp_mkdir($ftp_conn_1, $dir)){
							echo "Successfully created $dir";
							  }
							else
							  {
							  echo "Error while creating $dir";
							  }
						}
					}else{
						$dir = $path.'/'.$atm;
						if (ftp_mkdir($ftp_conn_1, $dir)){
						echo "Successfully created $dir";
						  }
						else
						  {
						  echo "Error while creating $dir";
						  }
					}
				}
				die;
				//$path = 'E:\FTP_DATA\HIKVISION\share';
				$checkimage_dir = $path .'/'.$atm.'/'.$custdate;
				//$checkfiles = ftp_nlist($ftp_conn_1, $checkimage_dir);
				
				$remote_dir = $checkimage_dir.'/'.$from_hour[0]; // change this
				//echo $src_file;die;
				//upload file
				if ($src_file!='')
				{
					// remote file path
					$dst_file = $remote_dir .'/'. $new_src_name;
					
					//ftp_chdir($ftp_conn_1,$remote_dir);
					$upload = ftp_put($ftp_conn_1, $dst_file, $_FILES["srcfile"]["tmp_name"], FTP_ASCII);
					
					// try to change the directory to somedir
				/*	if (ftp_chdir($ftp_conn_1, $remote_dir)) {
						echo "Current directory is now: " . ftp_pwd($ftp_conn_1) . "<br />";
						$dir_changed = "true";
						} else { 
							echo "Couldn't change directory\n";
							}
                 */
				// upload the file 
				/*	if($dir_changed == "true") {
						$upload = ftp_put($ftp_conn_1, $$new_src_name, $_FILES["srcfile"]["tmp_name"], FTP_BINARY); 

					// check upload status 
					    if ($upload===false) {  // check upload status
						 echo "<h2>FTP upload  has failed!</h2> <br />";
					    } else {
						  echo "Uploading Complete!<br /><br />";
					    }
				    }
				
					*/
					
					
					// ftp upload
					/*if (ftp_put($ftp_conn_1, $dst_file, $_FILES["srcfile"]["tmp_name"], FTP_ASCII))
						echo 'File uploaded successfully to FTP server!';
					else
						echo 'Error uploading file! Please try again later.';
					*/
					    if ($upload===false) {  // check upload status
						 echo "<h2>FTP upload  has failed!</h2> <br />";
					    } else {
						  echo "Uploading Complete!<br /><br />";
					    }
					
					// close ftp stream
					ftp_close($ftp_conn_1);
				}
            }
        ?>
        <!-- content-wrapper ends -->
       <!-- partial:partials/_footer.html -->
                    <?php include('footer.php');?>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js">
        </script>
        <script src="js/hoverable-collapse.js">
        </script>
        <script src="js/misc.js">
        </script>
        <script src="js/settings.js">
        </script>
        <script src="js/todolist.js"></script>
        <!--<script src="js/chart.js"></script>-->
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <script src="js/client_bank_circle_atmid.js"></script>
        <!-- End custom js for this page-->
        <!-- video.js -->
       <!-- <script src="js/dvrdashboard.js"></script>-->
		<script src="js/select2.js"></script>
        <!-- video.js -->
       <script>
	        $("#AtmID").change(function(){
				var AtmID= $("#AtmID").val();
				$('#atmid').val(AtmID);
			});


	   </script>
	   
	    <script src="plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
       <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
       <script src="plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!--   <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
      <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
       <script src="clockpicker/clockpicker.js"></script>
      

		<script>
		$(document).ready(function () {

		   // Date Picker
		   $('#S_date').datepicker({
				autoclose: true,
				todayHighlight: true
			});


			//Clock Picker
			//$('.clockpicker').clockpicker({
			//	donetext: 'Done'
			//});

		 
		});
		var time_input = $('#time-input-hh-mm-ss').clockpicker({
			placement: 'bottom',
			format: 'HH:mm:ss',
			align: 'left',
			autoclose: true,
			'default': 'now'
		});

		</script>


    
    </body>
</html>

