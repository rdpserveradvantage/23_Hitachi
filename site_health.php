<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    include('config.php');
    ?>
	
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
                    <?php include("filters/sitehealth_filter.php");?>
					
					    <div class="row form-group" >
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR online</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_online">0</h3>
                                                    
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
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_offline">0</h3>
                                                    
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
                            <!-- 
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">Panel Online</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="panel_online">0</h3>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-exclamation-triangle text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							 <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">Panel Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="panel_offline">0</h3>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-exclamation-triangle text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                            -->

                             
                        </div>

						  <div class="card">
							<div class="card-body">
							  <h4 class="card-title">DVR Health Status-Online</h4>
							  
							  
							  <div class="row">
								<div class="col-12" id="sitehealth_tbody">
								  <div class="table-responsive">
									<table id="order-listing" class="table">
									  <thead>
									 
										<tr>
											<th>Sno.</th>
											<th>DVR IP</th>
											<th>DVR Status</th>
											<th>Last DVR Communication</th>
											<th>HDD Status</th>
																	  
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
						<br> <br>

						  <div class="card">
							<div class="card-body">
							  <h4 class="card-title">DVR Health Status-Offline</h4>
							  
							  
							  <div class="row">
								<div class="col-12" id="sitehealth_tbody_offline">
								  <div class="table-responsive">
									<table id="order-listing2" class="table">
									  <thead>
									 
										<tr>
										
											<th>Sno.</th>
											<th>DVR IP</th>
											<th>DVR Status</th>
											<th>Last DVR Communication</th>
											<th>HDD Status</th>
											
																		
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
        <script src="js/site_health.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/data-table2.js"></script>
         <script src="js/select2.js"></script>
       <script>
         onload();
       </script>
    </body>
</html>
