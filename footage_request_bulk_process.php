<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
	date_default_timezone_set('Asia/Kolkata');
	if(isset($_POST['submit'])){
			$userid = $_SESSION['userid']; 
			$con = OpenCon();
			$date = date('Y-m-d h:i:s a', time());
			$only_date = date('Y-m-d');
			$target_dir = 'PHPExcel/';
			$file_name=$_FILES["images"]["name"];
			$file_tmp=$_FILES["images"]["tmp_name"];
			$file =  $target_dir.'/'.$file_name;
			$total_inserted = 0;$err_remarks="";
			$status ='open';                      
			$created_by = $_SESSION['userid'];
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
				//echo $atmid;
				//echo '<pre>';print_r($rowData[$i]);echo '</pre>';die;
				if($atmid){
					$sql = mysqli_query($con,"select * from sites where ATMID like '".$atmid."'");
					$call_receive = $rowData[$i][0][7];
					$component = $rowData[$i][0][8];
					$subcomponent =$rowData[$i][0][9];
					$docket_number =$rowData[$i][0][10];
					$remarks =$rowData[$i][0][11];
					 
					$amount = 'NULL';
					 
					$is_site_avail = 0; 
					
					if($sql_result = mysqli_fetch_assoc($sql)){
						$customer = strtoupper($sql_result['Customer']);
						$bank = $sql_result['Bank'];
						$location = $sql_result['SiteAddress'];
						$city = $sql_result['City'];
						$state = $sql_result['State'];
						$zone = $sql_result['Zone'];
						$is_site_avail = 1;
					}else{
						$bank =$rowData[$i][0][1];
						$customer =$rowData[$i][0][2];
						$zone = $rowData[$i][0][3];
						$city = $rowData[$i][0][4];
						$state = $rowData[$i][0][5];
						$location = $rowData[$i][0][6];            
					}

					$atmid = $_POST['atmid'];
					$cardno = $_POST['cardno'];
					$dateoftxn = $_POST['dateoftxn'];
					$timeoftxn = $_POST['timeoftxn'];
					$newTime = date("H:i", strtotime("$timeoftxn"));
						// echo $newTime; die;
					$natureoftxn = $_POST['natureoftxn']; 
					$amountoftxn = $_POST['amountoftxn'];
					$txnnumber = $_POST['txnnumber'];
					$complaint_no = $_POST['complaint_no'];
					$complaint_date = $_POST['complaint_date'];
					$claim_date = $_POST['claim_date'];
					$created_at = $created_at;
					$updated_at = $created_at;
					if($is_site_avail==1){
						$statement = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`, `updated_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."','".$updated_at."') ";
						if(mysqli_query($con,$statement)){
							$total_inserted = $total_inserted + 1;
						}
					}else{
						$err_remarks .= 'Site is not available for ATMID :' . $atmid .'</br>' ; 
						
					}
				}else{
					$err_remarks .= 'ATMID is blank.</br>' ; 
				} 
			}
		CloseCon($con);
		
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
			height: 210px; */
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
		.videoplay_msg{
			display:none;
		}
	</style>
        <?php include('top-navbar.php');?>   
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        
						<div class="col-12 grid-margin">
						<h3 class="card-title">Bulk Footage Request Upload Message</h3>
									<div class="card">
										<div class="card-body">
										<?php if(isset($_POST['submit'])){ ?>
										    <div class="row">
											    <div class="col-sm-6">
												   <h3>Success</h3>
												   <span>Total records uploaded successfully : <?php echo $total_inserted;?></span>
												</div>  
												<div class="col-sm-6">
												   <h3>Error</h3>
												   <span><?php if($err_remarks==""){ echo 'No Error and all records uploaded successfully.';}else{ echo $err_remarks; }?></span>
												</div>   
											</div>  
										<?php }?>
											<div class="row">
											    <div class="col-sm-3">
												   <div>
													  <label class="col-sm-6 col-form-label"><br></label>
													  <div class="col-sm-3">
													     <a href="footage_request_bulk_upload.php" class="btn btn-primary">Back to Footage Bulk Upload</a>
													  
													  </div>
												   </div>
												</div>  
											    
											</div>
										</div>	
									</div>
						</div>		
					</div>
				</div>
			</div>
			<?php include('footer.php');?>
		</div>
	</div>
</div>	
<script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/select2.js"></script>
        <script src="vendors/video-js/video.min.js">
        </script>
 </body>
</html>

