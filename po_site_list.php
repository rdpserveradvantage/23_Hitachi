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
											<th>Purchase Order ID</th>
											<th>Site Name</th>
											<th>Start Date</th>
											<th>Completion Date</th>
											<th>Total Penalty</th>
											<th>Total Week Extended</th>
											<th>Client Approved</th>
											<th>Vendor Approved</th>
											<th>Status</th>
											<th>Action</th>	  
										</tr>
									  </thead>
									  <tbody>
										  <?php $con = OpenCon();
												$i=1;
												$sql = mysqli_query($con,"select * from esurv_po_sites order by id desc");
												while($sqlfetch = mysqli_fetch_assoc($sql)){
													$purchase_order_id = $sqlfetch['po_id'];
													$po_sql = mysqli_query($con,"select po_number from esurv_po where id='".$purchase_order_id."' order by id desc");
													$po_sqlfetch = mysqli_fetch_assoc($po_sql);
													$purchase_order_number = $po_sqlfetch['po_number'];
													$site_name = $sqlfetch['site_name'];
													$start_date = $sqlfetch['start_date'];
													$completion_date = $sqlfetch['completion_date'];
													$total_penalty = $sqlfetch['total_penalty'];
													$extended_week = $sqlfetch['no_of_week_extended'];
													$is_completed = $sqlfetch['is_completed'];
													$status = "Not Completed";
													
													$start_date = date("d/m/Y",strtotime($start_date));
													$completion_date = date("d/m/Y",strtotime($completion_date));
													
													if($is_completed==2){
														$client_approval = "Yes";
														$status = "Completed";
													}
													else {
														$client_approval = "No";
													}
													
													if($is_completed==1){
														$vendor_approval = "Yes";
													} else {
														$vendor_approval = "No";
													}
													
												
											?>
												<tr>
													<td><?php echo $i;?></td>
													<td><?php echo $purchase_order_number;?></td>
													<td><?php echo $site_name;?></td>
													<td><?php echo $start_date;?></td>
													<td><?php echo $completion_date;?></td>
													<td><?php echo $total_penalty;?></td>
													<td><?php echo $extended_week;?></td>
													<td><?php echo $client_approval;?></td>
													<td><?php echo $vendor_approval;?></td>
													<td><?php echo $status;?></td>
													<td><a href='esurv_po_sites_edit.php?id=<?php echo $sqlfetch['id'];?> '><button type="button" class="btn btn-primary" name="edit" id="edit">Edit</button></a></td>
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
