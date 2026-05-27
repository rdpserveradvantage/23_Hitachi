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
	<?php 	$total_get = 0;
	        if(isset($_GET["id"])){
		        $id = $_GET["id"];
				$total_get = $total_get + 1;
        	}
			if(isset($_GET["atmid"])){
				$total_get = $total_get + 1;
				$atm_id = $_GET["atmid"];
			}
						 ?>			
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
			 <div class="center">
				<h3 class="page-title" >
					Manual Footage Request Upload
				</h3>
			  </div>



            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav> -->
          </div>
        <?php if($total_get==2){?>
				  <div class="row">
					<div class="col-12 grid-margin">
								 <?php //include('filters/sitehealth_filter.php');
								   // include('filters/add_footagerequest_filter.php');
									
								 ?>
					</div>   
					<div class="col-md-12 grid-margin stretch-card">
					  <div class="card">
										   
					  <div class="card-body">
						  <h4 class="card-title">Manual Footage Request Upload</h4>
						  <form id="form" method="POST" action="footage_request_manual_upload_process.php" enctype="multipart/form-data">
									<input type="hidden" name="footage_id" value="<?php echo $id;?>"> 
											  <div class="row">

													  <div class="col-md-4">
														<div class="form-group row">
														  <label class="col-sm-4 col-form-label">AtmID : </label>
														  <div class="col-sm-9">
															<input type="text" class="form-control" readonly required name="atmid" id="atmid" value="<?php echo $atm_id;?>" />
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
													<input type="submit" name="submit" value="Upload File to Server" class="btn btn-warning"/>
												</div>
							<!--<button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>-->
							<!--<button class="btn btn-light">Cancel</button>-->
						  </form>
						</div>
					  </div>
					</div>

				  </div>
		  
		  <?php }else{  ?>	
		      <button class="btn btn-light"><a href="dash_board_footage_request.php">Back To Footage Request Dashboard</a></button>
		  <?php }?>  
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

