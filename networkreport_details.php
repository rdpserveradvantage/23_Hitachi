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
		th, td {
			white-space: nowrap;
		}
	</style>
	
    <?php include('top-navbar.php');
	      $Client = $_GET['client'];
	      $Bank = $_GET['bank'];
		  $Circle = $_GET['circle'];
	      $AtmID = $_GET['atmid'];
		  $dvrstatus = $_GET['status'];
		  $device = $_GET['device'];
		  $_status = "Working";
		  if($dvrstatus=='0'){
			  $_status = "Not Working";
		  }
		  if($device=='D'){
			  $devicename = 'DVR';
		  }
		  if($device=='P'){
			  $devicename = 'Panel';
		  }
		  if($device=='R'){
			  $devicename = 'Router';
		  }
	?>
	        <input type="hidden" id="Client" value="<?php echo $Client;?>">
			<input type="hidden" id="Bank" value="<?php echo $Bank;?>">
			<input type="hidden" id="Circle" value="<?php echo $Circle;?>">
			<input type="hidden" id="AtmID" value="<?php echo $AtmID;?>">
			<input type="hidden" id="status" value="<?php echo $dvrstatus;?>">
			<input type="hidden" id="device" value="<?php echo $device;?>">
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
					    <div class="col-12 grid-margin">
                         <h6 class="card-title">Network Report - <?php echo $devicename;?></h6> 
                         
						</div>  
                        
                        <!-- Dashboard Charts -->
                        <div class="row form-group" >
                           
                                                 
                             <div class="col-lg-12 grid-margin stretch-card">
                                  <div class="card">
                                    <div class="card-body">
                                      <h4 class="card-title"><?php echo $_status; ?> List</h4>
                                     
										 <div class="row form-group" >
										     
										    <div class="table-responsive" id="siteonline_percent_table" style="min-height:300px;overflow-y:scroll;">
										 
										    </div>
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
        <script src="js/dashboard.js">
        </script>
        <!-- End custom js for this page-->
        <!-- video.js -->
       <!-- <script src="js/dvrhealthdashboard.js"></script>-->
		<script src="js/data-table.js"></script>
		
        <!-- video.js -->
         <script src="js/select2.js"></script>
       
        <script>
              onload();
			  function onload(){ debugger;
					var Client = $("#Client").val();
					var Bank = $("#Bank").val();
					var Circle = $("#Circle").val();
					var AtmID = $("#AtmID").val();
					var status = $("#status").val();
					var device = $("#device").val();
					$("#siteonline_percent_table").html('');
					if(Client==''){
						swal("Oops!", "Client Must Required !", "error");
						return false;
					}
					$('#siteonline_percent_table').html('');
					
					$("#load").show();
					$.ajax({
						url: "networkreport_table_ajax_list.php", 
						type: "GET",
						data: {client:Client,bank:Bank,circle:Circle,atmid:AtmID,status:status,device:device},
						dataType: "html", 
						success: (function (result) { 
						   $("#load").hide();
						   
						   $('#order-listing').dataTable().fnClearTable();
						   
						   $("#siteonline_percent_table").html(result);
						   $('#order-listing').DataTable(
								{
									"order": [[ 0, "desc" ]]
								}
							);
							
						})
					});  
				}  
        </script>
		
		
    
    </body>
</html>
