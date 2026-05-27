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
                  <h4 class="card-title">Footage Request Bulk Upload</h4>
				   <div class="two_end">
						<h5>Footage Request <span style="font-size:12px; color:red;">(Bulk Upload)</span></h5>
						<a class="btn btn-success" href="footage_bulk_format.xlsx" download>BULK UPLOAD FORMAT</a>
					</div>
					
					<?php 
                                  
                            if(isset($_POST['submit'])){
								    $total_data_insert = 0;$total_data_insert_atm_exist = 0;
									$userid = $_SESSION['userid']; 
                                    $con = OpenCon();
									$date = date('Y-m-d h:i:s a', time());
									$only_date = date('Y-m-d');
									$target_dir = 'PHPExcel/';
									$file_name=$_FILES["images"]["name"];
									$file_tmp=$_FILES["images"]["tmp_name"];
									$file =  $target_dir.'/'.$file_name;


									$status ='open';                      
									$created_by = $_SESSION['userid'];
									//date_default_timezone_set('Asia/Kolkata');    
									$created_at = date('Y-m-d H:i:s');




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
											
										  $atmid = $rowData[$i][0][0];
										 // echo $atmid;
										 // echo '<pre>';print_r($rowData[$i]);echo '</pre>';die;
											if($atmid){
												$sql = mysqli_query($con,"select * from sites where ATMID = '".$atmid."'");
											
											    if(mysqli_num_rows($sql)>0){ 
												    
														$cardno = $rowData[$i][0][1];
														$dateoftxn = $rowData[$i][0][2];
														
														if($dateoftxn!=''){
														  $dateoftxn =	date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($dateoftxn));
														 // $dateoftxn = date("Y-m-d",$dateoftxn);
														 //$dateoftxn = date("Y-m-d",strtotime($dateoftxn));
														}
														
														$timeoftxn =$rowData[$i][0][3];
														$start_time =$rowData[$i][0][4];
														$end_time =$rowData[$i][0][5];
														$natureoftxn =$rowData[$i][0][6];
														$amountoftxn =$rowData[$i][0][7];
														$txnnumber = $rowData[$i][0][8];
														
														if(isset($rowData[$i][0][9]))
														  $complaint_no =$rowData[$i][0][9];
													    else
														  $complaint_no = '';	
													  
													    if(isset($rowData[$i][0][10])) 
														  $complaint_date =$rowData[$i][0][10];
													    else
														  $complaint_date = '';
													  
														if($complaint_date!=''){
														 // $complaint_date = date("Y-m-d",$complaint_date);
														 // $complaint_date =	date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($complaint_date));
														  $complaint_date = date("Y-m-d",strtotime($complaint_date));
														}
														//echo $dateoftxn;die;
														if(isset($rowData[$i][0][11])) 
														  $claim_date =$rowData[$i][0][11];
													    else 
														  $claim_date = '';
													  
														if($claim_date!=''){
														//  $claim_date = date("Y-m-d",$claim_date);
														 // $claim_date =	date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($claim_date));
														  $claim_date = date("Y-m-d",strtotime($claim_date));
														}
														
														if(isset($rowData[$i][0][12])) 
														  $ticket_id =$rowData[$i][0][12];
													    else 
														  $ticket_id = '';
											 
													
														if($sql_result = mysqli_fetch_assoc($sql)){
															$customer = strtoupper($sql_result['Customer']);
															$bank = $sql_result['Bank'];
															$location = $sql_result['SiteAddress'];
															$city = $sql_result['City'];
															$state = $sql_result['State'];
															$zone = $sql_result['Zone'];
														}else{
																	 
														}
                                                       // echo $timeoftxn;
												        if($timeoftxn!=''){
														   $timeoftxn = date('H:i:s', PHPExcel_Shared_Date::ExcelToPHP($timeoftxn));
														}
														if($start_time!=''){
														   $start_time = date('H:i:s', PHPExcel_Shared_Date::ExcelToPHP($start_time));
														} 
														if($end_time!=''){
														   $end_time = date('H:i:s', PHPExcel_Shared_Date::ExcelToPHP($end_time));
														}
														
														//$created_at = date('Y-m-d H:i:s');
														$updated_at = date('Y-m-d H:i:s');
														
													//if($timeoftxn!='' && $start_time!='' && $end_time!='' && $claim_date!='' && $complaint_date!='' && $dateoftxn!=''){
													
													if($timeoftxn!='' && $start_time!='' && $end_time!='' && $dateoftxn!=''){
														if($ticket_id!=''){
															$checksql = mysqli_query($con,"select * from footage_request where ticket_id = '".$ticket_id."'");
															//echo mysqli_num_rows($checksql);die;
															if(mysqli_num_rows($checksql)==0){
																$statement = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `start_time`, `end_time`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `ticket_id`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$timeoftxn."', '".$start_time."', '".$end_time."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$ticket_id."') ";
																//echo $statement;die;
																if(mysqli_query($con,$statement)){
																	$total_data_insert = $total_data_insert + 1;
																			echo 'Request created for ATMID : ' . $atmid ; 
																			echo '<br>';
																}
															}
														}else{
															echo 'ATM ID : ' . $atmid . ' must have ticket id'; 
																echo '<br>';
														}
													}else{
														echo 'ATMID : ' . $atmid . ' must have all fields value'; 
																echo '<br>';
													}
											    }else{
													$total_data_insert_atm_exist = $total_data_insert_atm_exist + 1;
													//echo 'ATMID Not Exist : ' . $atmid ; 
														//		echo '<br>';
													$atm_notexist_statement = " INSERT INTO `footage_request_atm_not_exist`( `atmid`, `card_no`, `ticket_id`) VALUES ('".$atmid."','".$cardno."','".$ticket_id."') ";
													mysqli_query($con,$atm_notexist_statement);
												}
											}

									}
								CloseCon($con);
								echo 'Total Footage Data Inserted : '.$total_data_insert;echo '<br>';
								echo 'Total ATM Not Exist in Site Table : '.$total_data_insert_atm_exist;
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

