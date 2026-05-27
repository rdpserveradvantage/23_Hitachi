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
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">DVR online</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_online_count">0</h3>
                                                    
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
                                        <h4 class="card-title mb-0">DVR Offline</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="dvr_offline_count">0</h3>
                                                    
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
                             
                             <div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0">Critical Alarms</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0" id="total_alerts_count">0</h3>
                                                    
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
                             
                            <!--<div class="col-md-3 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-0 ">Branch Open close</h4>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-inline-block pt-3">
                                                <div class="d-md-flex">
                                                    <h3 class="mb-0">0</h3>
                                                    
                                                </div>
                                               
                                            </div>
                                            <div class="d-inline-block">
                                                <i class="fas fa-university text-info icon-lg"></i>                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  -->
                             
                        </div>
                        <!-- Dashboard Charts -->
                        <div class="row form-group" >
                             
                                 <div class="col-lg-4 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">Panel Status</h4>
                                      <div id="c3-pie-chart"></div>
                                    </div>
                                  </div>
                                </div>
                                                 
                                <div class="col-lg-4 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">DVR Status</h4>
                                      <div id="c3-pie-chart1"></div>
                                    </div>
                                  </div>
                              </div>
                             
                           
                             <div class="col-lg-4 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Alerts</h4>
                                  <div id="c3-pie-chart2"></div>
                                </div>
                              </div>
                            </div>
                             
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-6 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Sitewise Count of All tickets for Current Month</h4>
                                  <canvas id="areaChart"></canvas>
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title">Alert Type wise Chart For Day</h4>
                                  <!--<div id="c3-pie-chart3"></div>-->
								  <canvas id="pieChart"></canvas>
                                </div>
                              </div>
                            </div>
                        </div>
                        <div class="row form-group" >
                                 <div class="col-lg-8 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title">All Site wise count of all ticket</h4>
									  <div class="table-responsive" id="siteonline_percent_table">
                                       
                                      </div>
                                     <!-- <table class="table table-bordered table-striped" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>Site Name</th>
                                                  <th>Resolved</th>
                                                  <th>UnResolved</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              
                                          </tbody>
                                      </table> -->
                                    </div>
                                  </div>
                                </div>
                                                 
                               <!-- <div class="col-lg-4 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title text-white">Branch Open close time</h4>
                                      <table class="table table-bordered table-striped" width="100%">
                                          <thead>
                                              <tr>
                                                  <th>Site Name</th>
                                                  <th>Open time</th>
                                                  <th>Close time</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              
                                          </tbody>
                                      </table>
                                    </div>
                                  </div>
                              </div>-->
                             
                           
                             <div class="col-lg-4 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                  <h4 class="card-title text-white">Ticket Summary</h4>
                                  <table class="table table-bordered table-striped" width="100%">
                                          <thead>
                                              <tr>
                                                 
                                                  <th>Total (active)</th>
                                                  <th>Close</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                                <td id="total_active"></td><td id="total_closed"></td>
                                          </tbody>
                                      </table>
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
        <!--<script src="js/chart.js"></script>-->
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        <script src="js/client_bank_circle_atmid.js"></script>
        <!-- End custom js for this page-->
        <!-- video.js -->
        <script src="js/dvrdashboard.js"></script>
		<script src="js/select2.js"></script>
        <!-- video.js -->
        <!--
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart',
            data: {
              // iris data from R
              columns: [
                ['Inactive', 30],
                ['Active', 120],
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
              pattern: ['#F25D10', '#FF5E6D', '#A7B3FD']
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
              ids: 'Inactive'
            });
            c3PieChart.unload({
              ids: 'Active'
            });
          }, 2500);
        </script>
          -->
        <!--
        <script>
             var c3PieChart = c3.generate({
            bindto: '#c3-pie-chart2',
            data: {
              // iris data from R
              columns: [
                ['Closed', 30],
                ['Active', 120],
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
              ids: 'Closed'
            });
            c3PieChart.unload({
              ids: 'Active'
            });
          }, 2500);
        </script>  -->
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
              ids: 'data1'
            });
            c3PieChart.unload({
              ids: 'data2'
            });
          }, 2500);
        </script>
    
    </body>
</html>
