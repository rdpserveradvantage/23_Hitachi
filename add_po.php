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
		   div.card-body.table {
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
							  Add PO
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
							    <h4 class="card-title">Purchase Order</h4>
							    <div class="row">
								    <div class="col-12 grid-margin">
										<div class="card">
										  <div class="card-body">
											<h4 class="card-title"></h4>
											<form class="form-sample" action="esurv_po_insert.php" method="post" >
											  
											  <div class="row">
												<div class="col-md-4">
												    <div class="form-group">
													  <label for="PurchaseOrderNo">Purchase Order No.</label>
													  <input type="text" required class="form-control" id="po_no" name="po_no" placeholder="Purchase Order No.">
													</div>
												  
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="PurchaseOrderDate">Purchase Order Date</label>
													<input type="date" class="form-control" name="po_date" id="po_date" oninput="checkDate(this.value)" required/>
												  </div>
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="ClientName">Client Name</label>
													<input type="text" class="form-control" name="client_name" id="client_name" required />
												  </div>
												</div>
											  </div>
											  
											  <div class="row">
												<div class="col-md-4">
												  <div class="form-group">
													<label for="ProjectName">Project Name</label>
													<input type="text" class="form-control" name="proj_name" id="proj_name" required/>
												  </div>
												</div>
												
												<div class="col-md-4">
												  <div class="form-group">
													<label for="ExpectedDate">Expected Date of Completion</label>
													<input type = "hidden" id="expecteddate" name="expecteddate" >
													<input type="text" class="form-control" name="expected_date" id="expected_date"  readonly/>
												  </div>
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="Penalty">Penalty</label>
													<input type="text" class="form-control" name="penalty"  id="penalty" required/>
												  </div>
												</div>
											  </div>
													<input type="submit" id="submit" class="btn btn-success mr-2" value="Submit">
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
		function addDays(n,po_date){
        var t = new Date(po_date);
        t.setDate(t.getDate() + n); 
        var month = "0"+(t.getMonth()+1);
        var date = "0"+t.getDate();
        month = month.slice(-2);
        date = date.slice(-2);
         var date = date +"-"+month +"-"+t.getFullYear();
        // alert(date);
        document.getElementById("expected_date").value = date;
    }
    
   
      function checkDate()
      {
          var enterdate = $('#po_date').val();
        //   var days =      $('#expected_days').val();
        //   alert(days);
           var test = addDays(45,enterdate);
        //   alert(test);
      }
			</script>
    </body>
</html>
