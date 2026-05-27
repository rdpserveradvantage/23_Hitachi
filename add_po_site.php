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
							  Add PO Site
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
							    <h4 class="card-title">Purchase Order Site</h4>
							    <div class="row">
								    <div class="col-12 grid-margin">
										<div class="card">
										  <div class="card-body">
											<h4 class="card-title"></h4>
											<form class="form-sample" action="esurv_po_sites_insert.php" method="post" >
											  
											  <div class="row">
												<div class="col-md-4">
												    <div class="form-group">
													  <label for="PurchaseOrderID">Purchase Order ID</label>
													  <select class="form-control" name="purchase_id" id="purchase_id" required >
													  <option value="">Select</option>
													  <?php $con = OpenCon();
														$sql = mysqli_query($con,"select po_number,id from esurv_po");
														while($sqlfetch = mysqli_fetch_assoc($sql))
														{ ?>
															<option value="<?php echo $sqlfetch['id'];?>" ><?php echo $sqlfetch['po_number']; ?></option>
														<?php }
													     CloseCon($con);
													  ?>
													  </select>
													  </div>
												  
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="PurchaseOrderDate">Site Name</label>
													<input type="text" class="form-control" name="sitename" id="sitename" required/>
												  </div>
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="StartDate">Start Date</label>
													<input type="date" class="form-control" name="startdate" id="startdate" onclick="checkDate()" required/>
												  </div>
												</div>
											  </div>
											  
											  <div class="row">
												<div class="col-md-4">
												  <div class="form-group">
													<label for="CompleteDate">Complete Date</label>
													<input type="date" class="form-control" name="completedate" id="completedate" onclick="checkDate()" required/>
												  </div>
												</div>
												
												<div class="col-md-4">
												  <div class="form-group">
													<label for="ExpectedDate">Total Penalty</label>
													<input type="text" class="form-control" name="total_penalty" id="total_penalty" required/>
												  </div>
												</div>
												<div class="col-md-4">
												  <div class="form-group">
													<label for="Penalty">Total Week Extended</label>
													<input type="text" class="form-control" name="extented_week" id="extented_week" required  />
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
       
    </body>
</html>
