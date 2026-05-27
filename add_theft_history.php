<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	<link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
			overflow-y: scroll;
			text-align:justify; */
			overflow-x: scroll;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
                      <?php 
					    include("add_ticket_data.php");
					    $atm_id= ""; 
						$con = OpenCon();
					    if(isset($_GET['atmid'])){
						    $atm_id = $_GET['atmid'];
						    $client = get_atmdetails($atm_id,'Customer',$con);
							$bank = get_atmdetails($atm_id,'Bank',$con);
						 
							
						}
						
						
					    $err = ""; 
						if(isset($_GET['error'])){
						  $err = $_GET['error'];
						  if($err==1){ ?>
							  <script>alert("For this Alert Type Ticket Raised Already!");</script>
						 <?php }
						}
						?>      
     <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
				 
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
							<h3 class="page-title">
							  Theft History
							</h3>
							<!--<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Tables</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data table</li>
							  </ol>
							</nav>-->
						  </div>
						  <div class="card">
						    
						  
							<div class="card-body">
							  <h4 class="card-title"></h4>
							 
                                 <div class="row">
									
									
									<div class="col-12 grid-margin">
									  <div class="card">
										<div class="card-body">
										  <h4 class="card-title">Create New Ticket</h4>
										  <form class="form-sample" method="POST" action="theft_ticket_raise_process.php" enctype="multipart/form-data">
											<p class="card-description">
											  Ticket info
											</p>
											
											<div class="row">
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Client</label>
												  <div class="col-sm-9" name="client"> 
												    <?php if($atm_id==""){?>
													<select name="client" id="Client" class="form-control" onchange="onchangebank()" required>
													  <option value="">Select</option> 
														<?php if($_SESSION['client']=='All'){?>
														
														<?php echo getClients(); }
														   else{ 
														   $clients = explode(",",$_SESSION['client']);
														   for($i=0;$i<count($clients);$i++){ echo $clients[$i];?>
														   <option value="<?php echo $clients[$i];?>"><?php echo $clients[$i];?></option> 
														   <?php }  }?>
													  
													</select>
													<?php }else{ ?>
													 <input type="text" name="client" readonly value="<?php echo $client;?>">
													<?php }?> 
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Bank</label>
												  <div class="col-sm-9">
													
													 <?php if($atm_id==""){?>
													<select name="Bank" id="Bank" class="form-control" onchange="onchangeatmid()" required> 
														<option value="">Select</option>   
													</select>
													 <?php }else{ ?>
													 <input type="text" name="Bank" readonly value="<?php echo $bank;?>">
													 <?php }?>
													  
													
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATM ID</label>
												  <div class="col-sm-9">
													
													 <?php if($atm_id==""){?>
													<select name="atmid" id="AtmID" class="form-control js-example-basic-single w-100" required>
														<option value="">Select</option>
																					
													</select>
													 <?php }else{ ?>
													 <input type="text" name="atmid" readonly value="<?php echo $atm_id;?>">
													 <?php }?>
													  
													
												  </div>
												</div>
											  </div>
											</div>
											
											<div class="row">
											    <div class="col-md-12">
													<div class="form-group">
													  <label class="col-sm-3 col-form-label">Incidents</label>
													  <div class="col-sm-9">
														<input type="text" name="incident" class="form-control" required>
													  </div>
													</div>
												</div>
											</div>
											
											<div class="row">
											  <div class="col-md-6"> 
												   <div class="form-group">
														<label>Incident Date</label>
														<div>
															<div class="input-group">
																<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="incident_date" name="incident_date" value="" required>
																<div class="input-group-append">
																	<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
																</div>
															</div>
														</div>
													</div>
											  </div>
											  
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Upload File</label>
												  <div class="col-sm-9">
												      <input type="file" name="file[]" class="form-control">
												  </div>
												</div>
											  </div>
											</div>
											
											<p class="card-description">
											  Remarks
											</p>
											<div class="row">
											  <div class="col-md-12">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Ticket Remarks</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="remarks" />
												  </div>
												</div>
											  </div>
											 </div>
											<button type="submit" class="btn btn-primary mr-2">Submit</button>
										  </form>
										
									  </div>
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
        <script src="js/todolist.js">
        </script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js">
        </script>
		<script src="js/data-table.js"></script>
        <!-- End custom js for this page-->
		<script src="js/select2.js"></script>
		<script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script>
		jQuery(document).ready(function () {
		   // Date Picker
		   jQuery('#incident_date').datepicker({
				autoclose: true,
				todayHighlight: true
			});
		 
		});
		function onchangeatmid() {
				var bank = $("#Bank").val();
				$.ajax({
					type: "GET",
					url: "getMasterData.php", 
					data: {bank:bank},
					dataType: "html",
					success: (function (result) {
						$("#AtmID").html('');
						$("#AtmID").html(result);
					})
				})
			}
		function onchangebank() { 
				var client = $("#Client").val();
				$.ajax({
					type: "GET",
					url: "getMasterData.php", 
					data: {client:client},
					dataType: "html",
					success: (function (result) {
						$("#Bank").html('');
						$("#Bank").html(result);
					})
				})
			}	
			function onsetatmid() { 
				var AtmID = $("#AtmID").val();
				$.ajax({
					type: "GET",
					url: "getMasterData.php", 
					data: {allalertatmidwise:AtmID},
					dataType: "html",
					success: (function (result) {
						$("#alert_type").html('');
						$("#alert_type").html(result);
					})
				})
			}
			</script>
    </body>
</html>
