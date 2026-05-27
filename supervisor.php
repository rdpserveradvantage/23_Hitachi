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
                    height: 210px; */
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
                    <?php include("filters/supervisor_filter.php");?>
					
					<div class="row">
					     <div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
								   <h4 class="card-title">UserWise Count-Total Served Tickets: 32</h4>

									<div class="row">

										<div class="col-lg-6 grid-margin stretch-card">
											<div class="table-responsive">
												<table id="order-listing" class="table">
												
												</table>
											</div>
										</div>
								   
									
									</div>
								</div>
							</div>
					    </div>
						<div class="col-md-6 grid-margin stretch-card">
						    <div class="card">
								<div class="card-body">
                                      <h4 class="card-title">Top 5 Tickets which took more than 3 Mins Time:<input type="time"></h4>
									   <div class="row">
										<?php include("filters/supervisorscreen_filter.php")?>
										   
												
										</div>
                                </div> 	
                            </div>								
						</div>
					</div>
					
					
					<br>
					
					<div class="card">
                    <div class="card-body">
                    <h4 class="card-title">ClientWise Ticket Count</h4>

                    <div class="row">

                    <div class="col-lg-6 grid-margin stretch-card" >
                    <div class="table-responsive">
                    <table id="order-listing3" class="table">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Login User</th>
                            <th>Login Status</th>
                        </tr>
                    </thead>
                    <tbody  id="clientwise_tbody">
                       
                    </tbody>
                    </table>
                    </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        
                            <div class="card-body">
                                <h4 class="card-title" style="color:#fff;">Top 5 type of Alarm with Count</h4>
                                    <div id="sparkline-pie-chart"></div>
                            </div>
                        
                    </div>
					
                    </div>
                    </div>
                    </div>
					<br>
					
                    <div class="card">
                    <div class="card-body">
                    <h4 class="card-title" style="color:#fff;">Hourwise User Details</h4>

                    <div class="row">

                    <div class="col-12">
                    <div class="table-responsive">
                    <table id="order-listing2" class="table">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Login User</th>
                            <th>Login Status</th>
                            <th>Login Time</th>
                            <th>CME IP</th>
                            <th>LogOut/Current Time</th>
                            <th>Duration</th>
                            <th>Status</th>
                                                           
                        </tr>
                    </thead>
                    <tbody  id="hourwise_tbody">
                        
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
					<script src="js/sparkline.js">
                    </script>
                    <script src="js/supervisor.js">
                    </script>
                    <!-- <script src="js/data-table.js"></script>
                    <script src="js/data-table2.js"></script> -->

                    
                    <script>
                        onload();
                    </script>
                 
                    </body>
                    </html>
