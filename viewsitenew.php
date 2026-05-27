<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // session_start();
	$_user_id = $_SESSION['access'];
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
			overflow-y: scroll;*/
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
                    
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">View Site</h4>
			  <?php include('filters/sitehealth_filter.php');?>
			  <?php //include("filters/viewsite_filter.php");?>
			  
              <div class="row">
                <div class="col-12" id="ticketview_tbody">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
						    <?php if($_user_id==1){?>
                            <th>Action</th>
							<?php }?>
							<th>ATMID</th>
                            <th>ATMID 2</th>
                            <th>ATMID 3</th>
                            <th>ATMID 4</th>
                            <th>Tracker No.</th>
                            <th>ATM ShortName</th>
                            <th>Phase</th>
                            <th>Status</th>
                            <th>Old Panel ID</th>
                            <th>New Panel ID</th>
                            <th>DVR IP</th>
                            <th>DVR Name</th>
                            <th>Panel IP</th>
                            <th>DVR Model Number</th>
                            <th>Router Model Number</th>
                            <th>Engineer Name</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Site Address</th>
                            <th>State</th>
                            <th>City</th>
							<th>Zone</th>
                            <th>Panel Make</th>
                            <th>Live</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Remark</th>
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
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/dashboard.js"></script>
        <script src="js/siteview.js"></script>
        <script src="js/data-table.js"></script>
        <script src="js/select2.js"></script>


    </body>
</html>
