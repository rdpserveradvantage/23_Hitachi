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
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    <?php //include("filters/footagerequest_filter.php");?>
							<div class="card"> 
								<div class="card-body">
									<div class="col-12 grid-margin">
										
										<div class="row">	
											<div class="col-md-3">
														<div class="form-group">
															<label for="Status">Select Status</label>
																<select name="status" id="status" class="form-control" >
																		<option value="all">All</option>
																		<option value="0">Pending</option>
																		<option value="1">Processing</option>
																		<option value="2">Completed</option>
																		
																	</select>
																
														</div>
											</div>

											<div class="col-md-3">
												<div class="form-group">
															<label for="button"></label><br>
													 <button class="btn btn-primary" id="show_detail" >Show</button>
												</div>	 
											</div>
											<!--<a href="" class="btn btn-primary" id="Button">Clear</a>-->
											
										</div>
									</div>
								</div>
							</div>
							<br>  										

						  <div class="card">
							<div class="card-body">
							  <h4 class="card-title">Footage Download Excel List</h4>
							  
							  
							  <div class="row">
								<div class="col-12" id="footagerequest_tbody">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
									 
										<tr>
											<th>S.No.</th>
											<th>IP</th>
											<th>Cam No.</th>
											<th>From</th>
											<th>To</th>
											<th>PC No.</th>
											<th>Status</th>
											<th>Created Date</th>
											<th>Updated Date</th>
											<th>Created By</th>
																	  
										</tr>
									  </thead>
									  <tbody>
										
									  </tbody>
									</table>
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
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
        
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
        <script src="js/dashboard.js">
        </script>
        <script src="js/multiplefootagedownloadprocess.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/data-table2.js"></script>
         <script src="js/select2.js"></script>
       
    </body>
</html>
