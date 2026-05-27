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
		    <div class="col-12 grid-margin">
                         <?php //include('filters/sitehealth_filter.php');
						    include('filters/add_footagerequest_filter.php');
						 ?>
			</div>   
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                                   
              <div class="card-body">
                  <h4 class="card-title">Create Footage Request </h4>
				  <form id="form" method="POST" action="footage_request_process.php" enctype="multipart/form-data">
                                      <div class="row">

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">AtmID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" readonly required name="atmid" id="atmid" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Card Number</label>
												  <div class="col-sm-9">
													<input type="number" class="form-control" required name="cardno" id="cardno" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Date Of TXN</label>
												  <div class="col-sm-9">

														<input type="date" class="form-control" required name="dateoftxn" id="dateoftxn" value="" />
												  </div>
												</div>
											  </div>
											</div>
											<div class="row">

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Time of TXN</label>
												  <div class="col-sm-9">
													<input type="time" class="form-control" required name="timeoftxn" id="timeoftxn" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Start Time</label>
												  <div class="col-sm-9">
													<input type="time" class="form-control" required name="start_time" id="start_time" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">End Time</label>
												  <div class="col-sm-9">
													<input type="time" class="form-control" required name="end_time" id="end_time" value="" />
												  </div>
												</div>
											  </div>

											  

											</div>
                                            <div class="row">

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">TXN Number</label>
												  <div class="col-sm-9">
													<input type="number" class="form-control" name="txnnumber" id="txnnumber" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Nature of TXN</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control"  required name="natureoftxn" id="natureoftxn" value="" />
												  </div>
												</div>
											  </div>
											   <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Amount of TXN</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="amountoftxn" id="amountoftxn" value="" />
												  </div>
												</div>
											  </div>
											</div>

                                            <div class="row">

											 <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Claim Date</label>
												  <div class="col-sm-9">
													<input type="date" class="form-control" name="claim_date" id="claim_date" value="" >
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Complaint Number</label>
												  <div class="col-sm-9">
													<input type="number" class="form-control" name="complaint_no" id="complaint_no" value="" />
												  </div>
												</div>
											  </div>
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-4 col-form-label">Complaint Date</label>
												  <div class="col-sm-9">
													<input type="date" class="form-control" name="complaint_date" id="complaint_date" value="" >
												  </div>
												</div>
											  </div>
											</div>
                    <button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                    <!--<button class="btn btn-light">Cancel</button>-->
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
    
    </body>
</html>

