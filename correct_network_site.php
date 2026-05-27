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
                            
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
				<?php //$con = OpenCon();
                   // include('view_ticket_data.php');
					$success = ""; 
					if(isset($_GET['success'])){
						  $success = $_GET['success'];
						  if($success==1){ ?>
							  <script>alert("Ticket Raised Successfully");</script>
						 <?php }
					  }
                 ?>
				 

                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
							<h3 class="page-title">
							  Ticket Raise Detail
							</h3>
							<!--<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Tables</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data table</li>
							  </ol>
							</nav>-->
							 
						  </div>
						  <?php //include("filters/ticketraise_filter.php");?>
						  <div class="card">
						    						  
							<div class="card-body">
							  <h4 class="card-title"></h4>
							  <?php include("filters/sitehealth_filter.php");?>
							  <div class="row">
								<div class="col-12" id="ticketview_tbody">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
										<tr>
											<th>ATMID</th><th>Location</th>
											<th>Status</th>
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
		<script src="js/client_bank_circle_atmid.js"></script>
		<script src="js/correct_network_site.js"></script>
		<script src="js/data-table.js"></script>
		<script src="js/modal-demo.js"></script>
        <!-- End custom js for this page-->
         <!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ticket Raise History</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body" id="result_status">
                           <h6>Ticket Details</h6>
							  <div class="card">
								<div class="card-block" id="result_status" style=" overflow: auto;">
								  
								</div>
							</div>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
				   <!-- Modal starts -->
                  
                  <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel-2">Update Remarks</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
						<form>
                        <div class="modal-body" >
                            
										<div class="row">
											<input type="hidden" id="Id" name="id">
											<input type="hidden" id="alert_type" name="alert_type" value="">
											<div class="col-sm-12">
											    <select class="form-control" name="ticket_status">
												   <option value="1">Pending</option>
												   <option value="0">Close</option>
												</select>
											</div>
											<div class="col-sm-12">
												<br>
												<label>Remarks</label>
												<input type="text" name="remarks" class="form-control" id="remarks">
											</div>
											
										</div>
									
								
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Submit</button>
                          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
                        </div>
						</form>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
			<script>
                $(document).on("click", ".small-modal", function () {
					 var Id = $(this).data('id');
					 $(".modal-body #Id").val( Id );
					 
				});
				$(document).on("click", ".large-modal", function () { debugger;
					 var Id = $(this).data('id');
					  $.ajax({    
						type: "GET",
						url: "ticket_history_details.php?id="+Id,             
						dataType: "html",   //expect html to be returned                
						success: function(response){            debugger;         
							$(".modal-body #result_status").html(response); 
							//alert(response);
						}
					 });
				});
				$('#smallModal form').on('submit', function (e) {

				  e.preventDefault();
				  $("#smallModal .btn-success").hide();
				  $.ajax({
					type: 'post',
					url: 'process_ticket_action.php',
					data: $('#smallModal form').serialize(),
					success: function (msg) { debugger;
					if(msg==0){
						alert("Cannot Updated Remarks");
					}else{
						alert("Remarks Updated Successfully");
					}
					$("#smallModal .btn-success").show();
					$('#smallModal').modal('toggle'); 
					}
				  });

				});
            </script>			
    </body>
</html>
