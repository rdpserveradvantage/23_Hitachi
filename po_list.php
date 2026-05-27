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
							  <h4 class="card-title">PO List</h4>
							  
							  
							  <div class="row">
								<div class="col-12" id="footagerequest_tbody">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
									 
										<tr>
											<th>Sr NO.</th>
											<th>Purchase order no</th>
											<th>Purchase date</th>
											<th>Client</th>
											<th>Project Name</th>
											<th>Expected Completion Date</th>	  
										</tr>
									  </thead>
									  <tbody>
										  <?php $con = OpenCon();
													$i=1;
													$sql = mysqli_query($con,"select * from esurv_po order by po_number desc");
													while($sqlfetch = mysqli_fetch_assoc($sql)){
														$po_number = $sqlfetch['po_number'];
														$po_date = $sqlfetch['po_date'];
														$client_name = $sqlfetch['client'];
														$proj_name = $sqlfetch['proj_name'];
														$expected_date = $sqlfetch['expected_completion_date'];
													
												?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $po_number;?></td>
													<td><?php echo $po_date;?></td>
													<td><?php echo $client_name;?></td>
													<td><?php echo $proj_name;?></td>
													<td><?php echo $expected_date;?></td>
												</tr>
												<?php $i++; } CloseCon($con); ?>
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
        <script src="js/footagerequest.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/data-table2.js"></script>
         <script src="js/select2.js"></script>
       
    </body>
</html>
