	<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	
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
						  //$sensorlist = getallalerttype($atm_id);
						    
						    $sql = mysqli_query($con,"select Panel_Make from sites where ATMID='".$atm_id."'");
							$sql_result = mysqli_fetch_assoc($sql);
							$panel_name = $sql_result['Panel_Make'];
							$paramater = 'SensorName';
							if($panel_name=='comfort'){
								$sql = mysqli_query($con,"select $paramater from comfort");
							}
							if($panel_name=='rass_boi'){
								$sql = mysqli_query($con,"select $paramater from rass_boi");
							}
							if($panel_name=='rass_pnb'){
								$sql = mysqli_query($con,"select $paramater from rass_pnb");
							}
							if($panel_name=='smarti_boi'){
								$sql = mysqli_query($con,"select $paramater from smarti_boi");
							}
							if($panel_name=='smarti_pnb'){
								$sql = mysqli_query($con,"select $paramater from smarti_pnb");
							}
							if($panel_name=='RASS'){
								$sql = mysqli_query($con,"select $paramater from rass where status=0");
							}
							if($panel_name=='rass_cloud'){
								$sql = mysqli_query($con,"select $paramater from rass_cloud where status=0");
							}
							if($panel_name=='rass_cloudnew'){
								$sql = mysqli_query($con,"select $paramater from rass_cloudnew where status=0");
							}
							if($panel_name=='rass_sbi'){
								$sql = mysqli_query($con,"select $paramater from rass_sbi where status=0");
							}
							if($panel_name=='SEC'){
								$sql = mysqli_query($con,"select $paramater from securico where status=0");
							}
							if($panel_name=='securico_gx4816'){
								$sql = mysqli_query($con,"select $paramater from securico_gx4816 where status=0");
							}
							if($panel_name=='sec_sbi'){
								$sql = mysqli_query($con,"select $paramater from sec_sbi where status=0");
							}
							if($panel_name=='Raxx'){
								$sql = mysqli_query($con,"select $paramater from raxx where status=0");
							}
							if($panel_name=='SMART -I'){
								$sql = mysqli_query($con,"select $paramater from smarti where status=0");
							}
							if($panel_name=='SMART-IN'){
								$sql = mysqli_query($con,"select $paramater from smartinew where status=0");
							}
							
						}
						$alarm_type ="";
						if(isset($_GET['alarmtype'])){
						  $alarm_type = $_GET['alarmtype'];
						  if($alarm_type==0){
							  $alarmtype = "Panel";
						  }
						  if($alarm_type==1){
							  $alarmtype = "DVR";
						  }
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
							  Ticket Raise
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
										  <form class="form-sample" method="POST" action="ticket_raise_process.php">
										     <input type="hidden" id="created_by" name="created_by" value="<?php echo $_SESSION['userid'];?>">
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
													<select name="atmid" id="AtmID" class="form-control js-example-basic-single w-100" onchange="onsetatmid()" required>
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
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Alert Type</label>
												  <div class="col-sm-9">
													<select class="form-control" name="alert_type" id="alert_type" required>
													  <?php if($atm_id==""){?>
													  
													  <?php }else{ 
                                                         while($sensor_sql_result = mysqli_fetch_assoc($sql)){ ?>
														   <option value="<?php echo $sensor_sql_result['SensorName'];?>"><?php echo $sensor_sql_result['SensorName'];?></option>
													  <?php } }?>
													</select>
												  </div>
												</div>
											  </div>
											  <div class="col-md-6">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Alarm Type</label>
												  <div class="col-sm-9">
												   <?php if($alarm_type==""){?>
													     <select class="form-control" name="alarm_type" required>
														 <!-- <option value="DVR">DVR</option>
														  <option value="Panel">Panel</option> -->
														  <option value="Alert">Alert</option>
														</select>
													   <?php }else{ ?>
													 <input type="text" name="alarm_type" readonly value="<?php echo $alarmtype;?>">
													 <?php }?>
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
        <script>
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
