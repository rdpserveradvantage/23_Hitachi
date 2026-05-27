<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	
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
                Footage Request
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
		     
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                                   
              <div class="card-body">
                  <h4 class="card-title">Multiple Footage Download Excel Upload</h4>
				   <div class="two_end">
						<h5>Multiple Footage Download Request <span style="font-size:12px; color:red;">(Bulk Upload)</span></h5>
						<a class="btn btn-success" href="Multiple_Footage_Download_Bulk.xlsx" download>BULK UPLOAD FORMAT</a>
					</div>
					
					<?php 
                                      
                            if(isset($_POST['submit'])){
									$userid = $_SESSION['userid']; 
                                    $con = OpenCon();
									//$date = date('Y-m-d h:i:s a', time());
									$only_date = date('Y-m-d');
									$target_dir = 'PHPExcelMultipleFootage/';
									$file_name=$_FILES["images"]["name"];
									$file_tmp=$_FILES["images"]["tmp_name"];
									$file =  $target_dir.'/'.$file_name;

									$status = 0;                      
									$created_by = $_SESSION['userid'];
									
									move_uploaded_file($file_tmp=$_FILES["images"]["tmp_name"],$target_dir.'/'.$file_name);
									include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
									$inputFileName = $file;

									try {
										$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
										$objReader = PHPExcel_IOFactory::createReader($inputFileType);
										$objPHPExcel = $objReader->load($inputFileName);
									} catch (Exception $e) {
										die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' . 
											$e->getMessage());
									}

									$sheet = $objPHPExcel->getSheet(0);
									$highestRow = $sheet->getHighestRow();
									$highestColumn = $sheet->getHighestColumn();

								    for ($row = 1; $row <= $highestRow; $row++) { 
										$rowData[] = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, 
																		null, true, false);
									}

									$row = $row-2;
									$error = '0';
									$contents='';
                                    
									for($i = 1; $i<=$row; $i++){
										  $err = 0;	
										  $ip = $rowData[$i][0][0];
										 
										 // echo '<pre>';print_r($rowData[$i]);echo '</pre>';
											if($ip){
											   //	$sql = mysqli_query($con,"select * from sites where ATMID like '".$atmid."'");
											    $camno = $rowData[$i][0][1];
											/*	if($camno==''){ echo 'cam';
													$err = 1;
												}else{
													if(is_int($camno)){
														
													}else{ echo 'm';
														$err = 1;
													}
												} */
												
												$from = $rowData[$i][0][2];
												if($from!=''){
													/*if (PHPExcel_Shared_Date::isDateTime($from) && !empty($from)) {
														 $from = '@' . (string) PHPExcel_Shared_Date::ExcelToPHP($from);
													 }*/
													// echo $from;
												 // $from =	date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP($from));
												  $from =	date('Y-m-d H:i:s', strtotime($from));
												 
												}
												//echo $from;die;
												$to =$rowData[$i][0][3];
												if($to!=''){
													/*if (PHPExcel_Shared_Date::isDateTime($from) && !empty($from)) {
														 $from = '@' . (string) PHPExcel_Shared_Date::ExcelToPHP($from);
													 }*/
												 // $to =	date('Y-m-d H:i:s', PHPExcel_Shared_Date::ExcelToPHP($to));
												 $to =	date('Y-m-d H:i:s', strtotime($to));
												}
												//echo $to;die;
												$pcno =$rowData[$i][0][4];
											/*	if($pcno==''){ echo 'pc';
													$err = 1;
												}else{
													if(is_int($pcno)){
														
													}else{ echo 'c';
														$err = 1;
													}
												} */
												
                                               // echo $err;die;
									//$newTime = date("H:i", strtotime("$timeoftxn"));
									
									//$created_at = date('Y-m-d');
									//$updated_at = date('Y-m-d');
								                if($err==0){
													$statement = " INSERT INTO `multiple_footage_download`( `ip`, `cam_no`, `from_datetime`, `to_datetime`, `pc_no`, `status`, `created_by`) VALUES ('".$ip."','".$camno."','".$from."','".$to."','".$pcno."','".$status."','".$created_by."') ";
													//echo $statement;die;
													if(mysqli_query($con,$statement)){
														echo 'Request created for Row : ' . $i ; 
														echo '<br>';
													}
										        } 
									        }

							        }
								    CloseCon($con);
                     	    }
							?>
					
                           <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            
                                            <div class="col-sm-4">
                                                <input type="file" name="images" class="form-control" required>
                                            </div>
                                            <div class="col-sm-4">
                                                  <input type="submit" name="submit" value="upload" class="btn btn-danger">
                                            </div>
                                                
                                        </div>
                                    </form>                
                </div>
              </div>
            </div>

          </div>
        </div>



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
        
        <!-- End custom js for this page-->
        <!-- video.js -->
        <script src="js/dvrdashboard.js"></script>
		<script src="js/select2.js"></script>
        <!-- video.js -->
       <script>
	        $("#AtmID").change(function(){
				var AtmID= $("#AtmID").val();
				$('#atmid').val(AtmID);
			});
	   </script>
    
    </body>
</html>

