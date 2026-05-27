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
					
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">Dashboard As on Date : <?php echo date('d/m/Y');?></h6> 
                          <?php include('filters/sitehealth_filter.php');?>
						</div> 
                        <!-- Dashboard Wighets -->
                        <div class="row form-group" >
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Total Sites</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="totalsites_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop-code text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Camera Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_working_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Camera Not Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_notworking_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-exclamation-triangle text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            
                             
                        </div>
                        <!-- Dashboard Charts -->
						
						<div class="card">
                            <div class="card-body">
								<div class="row">
									<div class="col-12" id="ticketview_tbody">
									  <div class="table-responsive">
										<table id="example" class="table">
										  <thead>
											<tr>
												<th>S.N</th>
												<th>ATM-ID</th>
												<th>IP</th>
												<th>State</th>
												<th>Camera1</th>
												<th>Address</th>
												<th>Last Communication</th>
												<th>Last File Uploaded</th> 
																		  
											</tr>
										  </thead>
										  <tbody >
											
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
		
			
<!-- Modal starts -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
							<!-- Modal heading -->
							<div class="modal-header">
								<h5 class="modal-title" 
									id="exampleModalLabel">
								  AI Alert Image
							  </h5>
								<button type="button" 
										class="close"
										data-dismiss="modal" 
										aria-label="Close">
									<span aria-hidden="true">
									  ×
								  </span>
								</button>
							</div>
		  
							<!-- Modal body with image -->
							<div class="modal-body">
							    <div id="aiimage"></div>
								<!--<img id="img_src" src="" width="100%"/>-->
							</div>
						</div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
		
		
		
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
        <script src="js/chart.js"></script>
		<script src="js/ai_sites_client_bank_circle_atmid.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dash_board_1.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
		/*  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});*/
		$(document).on("click", ".large-modal", function () { debugger;
			$("#aiimage").html('');
				 var getImageDate = $(this).data('id');
				// alert(getImageDate);
				// $(".modal-body #getImageDate2").val( getImageDate );

			 $.ajax({

							type: "POST",
							url: 'getimage_in_modal_1.php',
							data: 'date='+getImageDate,
							success:function(msg) {

									$("#aiimage").html(msg);


							}
						});


			});
		
		</script>

    
    </body>
</html>
