<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');
	$conn = OpenCon();
	      $bank_sql = mysqli_query($conn,"select * from bank");
			while($bank_sql_result = mysqli_fetch_assoc($bank_sql)){
				$bank[] = $bank_sql_result['name'];    
			}
				// var_dump($bank); die;
			//$city_sql = mysqli_query($con,"select * from quotation1citydet");
			$city_sql = mysqli_query($conn,"select * from ai_cities");
				while($city_sql_result = mysqli_fetch_assoc($city_sql)){
				$city[] = $city_sql_result['city'];    
			}

			$state_sql = mysqli_query($conn,"SELECT * FROM `states`");
				while($state_sql_result = mysqli_fetch_assoc($state_sql)){
				$state[] = $state_sql_result['name'];    
			}    
	?>
	
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
					
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">Edit AI Sites</h6> 
                          <?php //include('filters/sitehealth_filter.php');?>
						</div> 
						
						<form action="update_ai_sites.php" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-12 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<?php	
											$id = $_GET['id']; 											
												$sql = mysqli_query($conn,"select * from ai_sites where id = '".$id."' ");
												while($sql_result = mysqli_fetch_row($sql)){										
											
											?>
											
											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">Project</label>
													<div class="col-sm-12">

														<input type="hidden" name="site_id" id="site_id" value="<?=$id;?>" />

														<input type="text" class="form-control" name="project" id="project"
															value="<?=$sql_result[1]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">Customer </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="customer" id="customer"
															value="<?=$sql_result[2]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">Bank</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="bank" id="bank"
															value="<?=$sql_result[3]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">Atmid</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="atmid" id="atmid"
															value="<?=$sql_result[4]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">Location</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="location" id="location"
															value="<?=$sql_result[5]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">Site Address </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="site_add" id="site_add"
															value="<?=$sql_result[6]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">City</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="city" id="city"
															value="<?=$sql_result[7]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">State </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="state" id="state"
															value="<?=$sql_result[8]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">Zone </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="zone" id="zone"
															value="<?=$sql_result[9]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">New PanelID </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="new_panelid" id="new_panelid"
															value="<?=$sql_result[10]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">DVR IP</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="dvrip" id="dvrip"
															value="<?=$sql_result[11]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">DVR Name</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="dvrname" id="dvrname"
															value="<?=$sql_result[12]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">Username</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="usrname" id="usrname"
															value="<?=$sql_result[13]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">Password </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="pwd" id="pwd"
															value="<?=$sql_result[14]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">Live </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="live" id="live"
															value="<?=$sql_result[15]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label"> RTSP Stream </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="rtsp" id="rtsp"
															value="<?=$sql_result[16]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">Pie Username</label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="pieusrname" id="pieusrname"
															value="<?=$sql_result[17]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">Pie Password </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="piepwd" id="piepwd"
															value="<?=$sql_result[18]; ?>" />
													</div>
												</div>

											</div>

											<div class="row">
												<div class="col-md-4">
													<label class="col-form-label">Panel IP </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="panelip" id="panelip"
															value="<?=$sql_result[19]; ?>" />
													</div>

												</div>
												<div class="col-md-4">
													<label class="col-form-label">Alert Type </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="alerttype" id="alerttype"
															value="<?=$sql_result[20]; ?>" />
													</div>

												</div>

												<div class="col-md-4">
													<label class="col-form-label">SN </label>
													<div class="col-sm-12">
														<input type="text" class="form-control" name="serialno" id="serialno"
															value="<?=$sql_result[21]; ?>" />
													</div>
												</div>

											</div>
											<?php } ?>
										</div>
										<div class="card-body">
											<button type="submit" id="submit" class="btn btn-primary mr-2">Update</button>
										</div>
									</div>
								</div>
							</div>
						</form>
                        
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
		
			
<!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
							<!-- Modal heading -->
							<div class="modal-header">
								<h5 class="modal-title" 
									id="exampleModalLabel">
								  Image
							  </h5>
								<button type="button" 
										class="close"
										data-dismiss="modal" 
										aria-label="Close">
									<span aria-hidden="true">
									  ×
								  </span>
								</button>
							</div>
		  
							<!-- Modal body with image -->
							<div class="modal-body">
								<img id="img_src" src="" width="100%"/>
							</div>
						</div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
		
		
		
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
        <script src="js/chart.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- <script src="js/networkreport_1.js"></script> -->
		<script src="js/networkreport_1_new.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
		  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});
		
		</script>

      
    </body>
</html>
<?php CloseCon($conn);?>
