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
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="header">
                            <h3 style="color:#fff;" >Excel Report</h3>
                        </div>
                    <?php include("filters/excelreport_filter.php");?>

          <div class="card">
            <div class="card-body">
            <h3 class="card-title" style="color:#fff;">Ticket Reports from <input type="date"> to <input type="date"> </h3>

              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     <br>
                        <tr>
                            <th>Customer</th>
                            <th>SiteAlertID</th>
							<th>Site Code</th>
                            <th>ATM ID</th>
                            <th>Location</th>
							<th>Address</th>
							<th>State Name</th>
                            <th>City Name</th>
                            <th>Alert Name</th>
							<th>Alert DateTime </th> 
                            <th>Status</th>
							<th>Closing Comment</th>
                            <th>Acknowlwdged By</th>
                            <th>Acknowledged On</th>
							<th>Closed By </th>       
                            <th>Closed On </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                           
                        </tr>
                        
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
        <script src="js/data-table.js">
        </script>
        <script src="vendors/video-js/video.min.js">
        </script>

    </body>
</html>
