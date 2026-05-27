<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
  //  include('config.php');
    ?>
	
	<style>
    .table thead th, .jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}
.card .card-body {
    padding: 1rem 1rem;
}
.card .card-title {
    color: #000000;
    font-weight: normal;
    margin-bottom: 1.25rem;
    text-transform: capitalize;
    font-size: 1rem;
}
		
	</style>
	
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
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
		
		  #online_percent_table_load{
    min-width: 200px;
    min-height: 200px;
    position:relative;
    z-index:9999;
    background:url("image/Circle.svg") no-repeat center center;
	margin-left: auto;
	margin-right: auto;
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
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">DVR Health Dashboard As on Date : <?php echo date('d/m/Y');?></h6> 
                          <?php include('filters/sitehealth_filter.php');?>
						</div>  
                        <!-- Dashboard Wighets -->
						<?php $test = 1;
						   if($test==1){ ?>
                        <div class="row form-group" >
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR online</h6>
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
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">DVR Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_offline_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-laptop text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title mb-0">Camera Online</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_online_count">0</h3>
                                                    
                                                </div>
                                                <!-- <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-camera text-success icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body" style="padding: 1rem 1em;">
                                        <h6 class="card-title mb-0 ">Camera Offline</h6>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="camera_offline_count">0</h3>
                                                    
                                                </div>
                                               <!--  <small class="text-gray">Raised from 89 orders.</small> -->
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-camera text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           <!--  <div class="col-md-2 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 ">Hdd fail</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="hdd_fail_count">0</h3>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-hdd text-danger icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  -->
                             
                        </div>
                        <!-- Dashboard Charts -->
						   <?php }else{ ?>
						       <div class="row form-group" >
                             
								 <div class="col-md-12 grid-margin">
									<div class="card">
										<div class="card-body">
											<h6 class="card-title mb-0"><b>Please Keep Patience. Work in Progress.</b></h6>
											
										</div>
									</div>
								</div>
							</div>
							  
						  <?php }?>
                        <div class="row form-group" >
                           
                                                 
                             <div class="col-lg-8 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Site Network Status Month Wise</h4>
                                     <div class="row form-group">
                                         <div class="col-md-4 form-group">
                                           <label>Month</label>
                                             <?php $month = date("m");?>
											 <select class="form-control" id="cmbMonth">
												  <option value="0">Select Month</option>
												  <option value="1" <?php if($month==1){ echo 'selected';}?>>Jan</option>
												  <option value="2" <?php if($month==2){ echo 'selected';}?>>Feb</option>
												  <option value="3" <?php if($month==3){ echo 'selected';}?>>Mar</option>
												  <option value="4" <?php if($month==4){ echo 'selected';}?>>Apr</option>
												  <option value="5" <?php if($month==5){ echo 'selected';}?>>May</option>
												  <option value="6" <?php if($month==6){ echo 'selected';}?>>June</option>
												  <option value="7" <?php if($month==7){ echo 'selected';}?>>July</option>
												  <option value="8" <?php if($month==8){ echo 'selected';}?>>Aug</option>
												  <option value="9" <?php if($month==9){ echo 'selected';}?>>Sept</option>
												  <option value="10" <?php if($month==10){ echo 'selected';}?>>Oct</option>
												  <option value="11" <?php if($month==11){ echo 'selected';}?>>Nov</option>
												  <option value="12" <?php if($month==12){ echo 'selected';}?>>Dec</option>

											  </select>
                                         </div>
                                         <div class="col-md-4 form-group">
                                           <label>Year</label>
										   <?php $year = date("Y");?>
                                             <select class="form-control" id="cmbYear">
												  <option value="0">Select Year</option>
											  <option value="2019" <?php if($year==2019){ echo 'selected';}?>>2019</option>
											  <option value="2020" <?php if($year==2020){ echo 'selected';}?>>2020</option>
											  <option value="2021" <?php if($year==2021){ echo 'selected';}?>>2021</option>
											  <option value="2022" <?php if($year==2022){ echo 'selected';}?>>2022</option>
											  <option value="2023" <?php if($year==2023){ echo 'selected';}?>>2023</option>
											  <option value="2024" <?php if($year==2024){ echo 'selected';}?>>2024</option>
											  <option value="2025" <?php if($year==2025){ echo 'selected';}?>>2025</option>
											  </select>
                                         </div>
                                         <div class="col-md-4 form-group">
                                            <label>&nbsp;</label></br>
                                           <button type="button" class="btn btn-info" onclick="getOnlinePercentDetail()">Submit</button>
                                         </div>
									</div>
										 <div class="row form-group" >
										    <div class="table-responsive" id="online_percent_table" style="min-height:300px;overflow-y:scroll;">
										         
										    </div>
											<div id="online_percent_table_load" style="display:none;"></div>
											  <!--  <div class="loader-demo-box">
													<div class="square-box-loader">
													  <div class="square-box-loader-container">
														<div class="square-box-loader-corner-top"></div>
														<div class="square-box-loader-corner-bottom"></div>
													  </div>
													  <div class="square-box-loader-square"></div>
													</div>
												  </div>  -->
										  </div>	
                                            										  
                                     
                                    </div>
                                  </div>
                              </div>
                             
                           
                             <div class="col-lg-4 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Site Network Status</h4>
                                  <div id="c3-pie-chart2"></div>
                                </div>
                              </div>
                            </div>
                             
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Total No Of Sites Online/Offline</h4>
                                  <div class="table-responsive" id="siteonline_percent_table">
                                       <table class="table table-bordered" width="100%">
										  <thead>
											  <th>Panel / Date</th>
											  <?php
											  for($i=1;$i<=31;$i++){ 
											  ?>
											 <th><?php echo $i;?></th>
											  <?php }?>
											 </thead>
										   <tbody id="sites_online_percent_tbody"> 
										   
										   </tbody>
									  </table>
                                  </div>
                                 
                                </div>
                              </div>
                            </div>                            
                        </div>
                        <div class="row form-group" >
                             
                             <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Bar Chart</h4>
                                  <div class="flot-chart-container">
                                    <!--<div id="column-chart" class="flot-chart"></div>-->
									 <div id="morris-bar-example"></div>
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
        <script src="js/todolist.js"></script>
        <script src="js/chart.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!--<script src="js/dashboard.js"></script>-->
        <!-- End custom js for this page-->
        <!-- video.js -->
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dvrhealthdashboard.js"></script>
		<script src="js/data-table.js"></script>
        <!-- video.js -->
         <script src="js/select2.js"></script>
       <!--
	   <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart',
            data: {
              // iris data from R
              columns: [
                ['offline', 30],
                ['online', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script>

         <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart1',
            data: {
              // iris data from R
              columns: [
                ['o', 30],
                ['data2', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script> 
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart2',
            data: {
              // iris data from R
              columns: [
                ['offline', 0],
                ['online', 0],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#FF5E6D', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'offline'
            });
            c3PieChart.unload({
              ids: 'online'
            });
          }, 2500);
        </script>
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart3',
            data: {
              // iris data from R
              columns: [
                ['data1', 30],
                ['data2', 120],
              ],
              type: 'pie',
              onclick: function(d, i) {
                console.log("onclick", d, i);
              },
              onmouseover: function(d, i) {
                console.log("onmouseover", d, i);
              },
              onmouseout: function(d, i) {
                console.log("onmouseout", d, i);
              }
            },
            color: {
              pattern: ['#6153F9', '#8E97FC', '#A7B3FD']
            },
            padding: {
              top: 0,
              right: 0,
              bottom: 30,
              left: 0,
            }
          });

          setTimeout(function() {
            c3PieChart.load({
              columns: [
                ["Income", 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ["Outcome", 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
                ["Revenue", 2.5, 1.9, 2.1, 1.8, 2.2, 2.1, 1.7, 1.8, 1.8, 2.5, 2.0, 1.9, 2.1, 2.0, 2.4, 2.3, 1.8, 2.2, 2.3, 1.5, 2.3, 2.0, 2.0, 1.8, 2.1, 1.8, 1.8, 1.8, 2.1, 1.6, 1.9, 2.0, 2.2, 1.5, 1.4, 2.3, 2.4, 1.8, 1.8, 2.1, 2.4, 2.3, 1.9, 2.3, 2.5, 2.3, 1.9, 2.0, 2.3, 1.8],
              ]
            });
          }, 1500);

          setTimeout(function() {
            c3PieChart.unload({
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script>
        -->
        
		
		
    
    </body>
</html>
