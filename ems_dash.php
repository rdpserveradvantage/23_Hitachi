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
                         <h3 class="card-title">EMS Dashboard</h3> 
                          <?php include('filters/sitehealth_filter.php');?>
						  <input type="hidden" id="usr" value="<?php echo $_SESSION['userid'];?>">
						</div>  
          <div class="row">
            <div class="col-12 grid-margin ">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"></h4>
                 <!--  <form id="example-form" action="#">
                    <div> -->
                      <h3>Electricity</h3>
                      
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Voltage (V)</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="R-Phase" id="r_v"/>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="Y-Phase" id="y_v" />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="B-Phase" id="b_v" />
                                  </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Current (A)</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="R-Phase" id="r_c" />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="Y-Phase" id="y_c" />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="B-Phase" id="b_c" />
                                  </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Load (kW)</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="R-Phase" id="r_real_kw"/>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="Y-Phase" id="y_real_kw" />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="B-Phase" id="b_real_kw" />
                                  </div>
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">PF</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="R-Phase"  id="r_pf"/>
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="Y-Phase" id="y_pf" />
                                  </div>
                                  <div class="col-sm-4">
                                    <input type="text" class="form-control"  placeholder="B-Phase"  id="b_pf"/>
                                  </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Frequency (Hz)</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="Frequency" id="fr"/>
                                  </div>
                                 
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Energy (kWh)</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="Energy" id="real_kwh"/>
                                  </div>
                                  
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">UPS Voltage</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="Voltage" id="e_v" />
                                  </div>
                                  
                                </div>
                            </div>
                        
                            <div class="col-md-6">
                                <label class="col-sm-3 col-form-label">Time</label>
                                <div class="form-group row">
                                  
                                  <div class="col-sm-9">
                                    <input type="text" class="form-control"  placeholder="Time" id="tm_stamp"/>
                                  </div>
                                  
                                </div>
                            </div>
                        </div>
                     </div>
                   </div>	
                   
                   <div class="card" style="margin-top:20px;margin-bottom:20px;">
                     <div class="card-body">				   
                      
                      <h3>Sensor</h3>
                      
                        
                        <div class="form-group">
                          <label>Temperature (°C)</label>
                          <input type="text" class="form-control"  placeholder="Values" id="temp">
                        </div>
                        <div class="form-group">
                          <label>Humidity (%)</label>
                          <input type="text" class="form-control" placeholder="Values" id="hum">
                        </div>
                        <div class="form-group">
                          <label>Earth Voltage (V)</label>
                          <input type="text" class="form-control" placeholder="Values" id="earth_volt">
                        </div>
                        <div class="form-group">
                          <label>UPS Output Current (A)</label>
                          <input type="text" class="form-control" placeholder="Values" id="acc_c">
                        </div>
                        <div class="form-group">
                          <label>Battery Voltage (V)</label>
                          <input type="text" class="form-control" placeholder="Values" id="bb_v">
                        </div>
					  </div>
                    </div>					
                    
                    <div class="card">
                       <div class="card-body">					
                      <h3>Devices</h3>
                        
                        <div class="row">
							<div class="col-12">
							  <div class="table-responsive">
								<table id="example" class="table">
								   <thead id="device_heading">
								     <tr>
									 <th>Devices</th><th>Serial No.</th><th id="label_1">Relay 1</th><th id="label_2">Relay 2</th><th id="label_3">Relay 3</th>
									 <th id="label_4">Relay 4</th> <th id="label_5">Relay 5</th><th>last online</th>
									 </tr>
								   </thead>
								   <tbody id="device_detail"></tbody>
								</table>
							  </div>
							</div>
						  </div>
                      
                   <!-- </div>
                  </form> -->
                </div>
              </div>
            </div>
          </div>
          <!--vertical wizard-->
          
        </div>
		
		<!--
		    <tr>
										<td>1</td>
										<td>2012/08/03</td>
										<td>Edinburgh</td>
										<td>New York</td>
										<td>$1500</td>
										<td>$3200</td>
										<td>
										  <label class="badge badge-info">On hold</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>2</td>
										<td>2015/04/01</td>
										<td>Doe</td>
										<td>Brazil</td>
										<td>$4500</td>
										<td>$7500</td>
										<td>
										  <label class="badge badge-danger">Pending</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>3</td>
										<td>2010/11/21</td>
										<td>Sam</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-success">Closed</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>4</td>
										<td>2016/01/12</td>
										<td>Sam</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-success">Closed</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>5</td>
										<td>2017/12/28</td>
										<td>Sam</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-success">Closed</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>6</td>
										<td>2000/10/30</td>
										<td>Sam</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-info">On-hold</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>7</td>
										<td>2011/03/11</td>
										<td>Cris</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-success">Closed</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>8</td>
										<td>2015/06/25</td>
										<td>Tim</td>
										<td>Italy</td>
										<td>$6300</td>
										<td>$2100</td>
										<td>
										  <label class="badge badge-info">On-hold</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>9</td>
										<td>2016/11/12</td>
										<td>John</td>
										<td>Tokyo</td>
										<td>$2100</td>
										<td>$6300</td>
										<td>
										  <label class="badge badge-success">Closed</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
									<tr>
										<td>10</td>
										<td>2003/12/26</td>
										<td>Tom</td>
										<td>Germany</td>
										<td>$1100</td>
										<td>$2300</td>
										<td>
										  <label class="badge badge-danger">Pending</label>
										</td>
										<td>
										  <button class="btn btn-outline-primary">View</button>
										</td>
									</tr>
		-->
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
        
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/wizard.js"></script>
  <!-- End custom js for this page-->
  <script src="js/client_bank_circle_atmid.js"></script>
  <script src="js/ems_dash.js"></script>
  <script src="js/data-table.js"></script>
   <script src="js/select2.js"></script>
</body>
</html>
