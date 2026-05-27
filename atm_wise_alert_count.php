<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // include('config.php');
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
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    <h2 class="card-title" >Alert Count</h2>
                    
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" >Site Details With Alert Count </h4>
			  <div class="row" style="margin-bottom:10px;">
			    <div class="col-md-6"></div>
			   <div class="col-md-6">
			     
			    </div>
			   </div>	 
               <div class="row">
                <div class="col-12" id="aiticketview_tbody">
                  <div class="table-responsive">
                    <table id="example" class="table">
                      <thead>
                     
                        <tr>
                            
							<th>ATMID</th>
							<th>Panel Name</th>
							<th>DVR Name</th>
                            <th>Alert Count</th>
                                                      
                        </tr>
                      </thead>
                      <tbody id="aiticketview_tbody">
                        
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
		
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/atm_wise_alert_count.js"></script>
        <script src="js/data-table.js"></script>
		<script src="js/select2.js"></script>

    </body>
</html>
