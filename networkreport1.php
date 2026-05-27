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
                         <h6 class="card-title">Site Network report As on Date : <?php echo date('d/m/Y');?></h6> 
                          <?php include('filters/networkreport_filter.php');?>
						</div> 
                        <!-- Dashboard Wighets -->
                        <div class="row form-group mb-0" >
                            <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-success">DVR Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop-code text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-success">Panel Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="panel_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-solar-panel text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-success">Router Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="router_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-inbox text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
						
						<div class="row form-group mt-0" >
                                                         
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-danger">DVR Not Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_offline_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop-code text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-danger">Panel Not Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="panel_offline_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-solar-panel text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-4 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 text-danger">Router Not Working</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="router_offline_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-inbox text-danger icon-lg"></i>                                    
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
									  <div class="table-responsive hidden">
										<!--<table id="order-listing" class="table">-->
										<table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="example">
										  <thead>
											<tr>
												<th>ATM-ID</th>
												<th>Site Address</th>
												<th>Router</th>
												<th>Router IP</th>
												<th>Router Last Communication</th>
												<th>Till Router Online %</th>
												<th>DVR</th>
												<th>DVR IP</th>
												<th>DVR Last Communication</th>
												<th>Till DVR Online %</th>
												<th>Panel</th>
												<th>Panel IP</th>
												<th>Panel Last Communication</th>
												<th>Till Panel Online %</th>
												
																  
											</tr>
										  </thead>
										 
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
								  Image
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
								<img id="img_src" src="" width="100%"/>
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
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/networkreport1.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
		  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});
		
		</script>
        <script>
      // $(document).ready(function(){
		  function newexportaction(e, dt, button, config) {
			 // $("#load").show();
			 var that = this;
			 // swal("Great!", "Export to Excel is processing...... Please Wait.", "success");

			  swal({
				 title: "Keep Patience",
				 text: "Export to Excel is processing...... Please Wait.",
				 type: "success",
				 timer: 1000
				 });
			 var self = this;
			 var oldStart = dt.settings()[0]._iDisplayStart;
			 dt.one('preXhr', function (e, s, data) {
				 // Just this once, load all data from the server...
				 data.start = 0;
				 data.length = 2147483647;
				 dt.one('preDraw', function (e, settings) {
					 // Call the original action function
					 if (button[0].className.indexOf('buttons-copy') >= 0) {
						 $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
						 $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
						 $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
						 $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-print') >= 0) {
						 $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
					 }
					 dt.one('preXhr', function (e, s, data) {
						 // DataTables thinks the first item displayed is index 0, but we're not drawing that.
						 // Set the property to what it was before exporting.
						 settings._iDisplayStart = oldStart;
						 data.start = oldStart;
					 });
					 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
					 setTimeout(dt.ajax.reload, 0);
					 // Prevent rendering of the full data to the DOM
					 return false;
				 });
			 });
			 // Requery the server with the new one-time export settings
			 dt.ajax.reload();
			 
		 } 
	 //  });
      </script>
    
    </body>
</html>
