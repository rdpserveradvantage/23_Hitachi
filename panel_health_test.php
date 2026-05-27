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
		th, td {
			white-space: nowrap;
		}
	</style>
	<style>
					 .cols_md_2{
						padding: 10px;
						margin: 10px;
					 }
					 .colorbox{
						padding: 10px;
						border-radius: 10px;
					 }
						aside.left-panel{
								min-width: 220px;
						}
					th{
							background: gray;
						color: white;
					}
					th,td{
						border: 1px solid;
					}
					 .red{
						background-color: red;
						color: white;
						text-align: center;
						border-radius: 10px;

					 }
					 .green{
					 background-color: green;
						color: white;	
						text-align: center;
						border-radius: 10px;
					 }
					 .white{
						background-color:white;
						color: black;
						text-align: center;
						border-radius: 10px;
						border: 1px solid black;
					 }
					.orchid{
						background-color: orchid;
						color: white;
						text-align: center;
						border-radius: 10px;
					}
					#thid7,#thid8,#thid9,#thid10,#thid31,#thid32,#thid33{
						display: none;
					}
					#tdid7,#tdid8,#tdid9,#tdid10,#tdid31,#tdid32,#tdid33{
						display: none;
					}

					<?php 

					for ($i=35; $i < 61; $i++) { 
					?>
						#tdid<?php echo $i; ?>,#thid<?php echo $i; ?>{
						display: none;
					 }
					<?php
					}
					 ?>


					</style>
                            
     <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
				<?php 
                  //  include('panel_health_data.php');
                 ?>
				 
					


                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
							<h3 class="page-title">
							  Panel Health
							</h3>
							<!--<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Tables</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data table</li>
							  </ol>
							</nav>-->
							
						  </div>
						  <?php include("filters/sitehealth_filter.php");?>
						  <div class="card">
						    <div class="card-body">
							
							    <div class="row" style="border-bottom:1px solid #333;margin-bottom:8px;">
								  <button class='badge badge-success badge-pill mb-2'>Closed</button>
								  <button class="badge badge-danger badge-pill mb-2">Open</button>
								  <button class="badge badge-warning badge-pill mb-2">Pending</button>
								   <button class="badge badge-info badge-pill mb-2">Sounder Reset</button>
								   
								   
							   </div>  
							   
							<!--	<div class="row" style="margin-left:120px">
									<div class="cols_md_2">
									 <button class="colorbox" style="background-color:red;color:white;text-align:center">Open</button> 
									</div>
									<div class="cols_md_2">
									  <button class="colorbox" style="background-color:green;color:white;text-align:center">Closed</button> 
									</div>
									  <div class="cols_md_2">
									 <button class="colorbox" style="background-color:orchid;color:white;text-align:center">ByPass-NotConnect</button> 
									</div>
									<div class="cols_md_2">
									 <button class="colorbox" style="background-color:yellow;text-align:center">Sounder ACK</button> 

									</div>
									<div class="cols_md_2">
									  <button class="colorbox" style="background-color:blue;color:white;text-align:center">Sounder Reset</button> 
									</div>
									<div class="cols_md_2">
									   <button class="colorbox" style="background-color:grey;text-align:center">Disconnect</button> 
									</div>
									<div class="cols_md_2">
									  <button class="colorbox" style="background-color:orange;color:white;text-align:center">Long Open</button> 
									</div>

								</div>  -->
							</div>
						  
							<div class="card-body">
							  <h4 class="card-title"></h4>
							  
							  
							    <div class="row">
									<div class="col-12" id="ticketview_tbody">
									 
									</div>

								 </div>
							  
							  <div class="row">
								<div class="col-12">
								 
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
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
		<script src="js/data-table.js"></script>
		<script src="js/panelhealth.js"></script>
		<script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        
    </body>
</html>
