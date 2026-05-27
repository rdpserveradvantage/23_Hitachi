<!DOCTYPE html>
<html lang="en">
<?php include('head.php');
	date_default_timezone_set('Asia/Kolkata');
	$query_date = date('Y-m-d');
	$start = date('Y-m-01', strtotime($query_date));
	$month = date('m');
	  
	$month = (int)$month;
	$year = date('Y');
		// Last day of the month.
	$end = date('Y-m-t', strtotime($query_date));
	$start = '2022-03-01';
    $end = '2022-03-31';	  
    $month = 3;
	$con = OpenCon();
	 // $sql = mysqli_query($con,"select SN,DVRIP,ATMID,SiteAddress from sites where live='Y'");
	$sql = mysqli_query($con,"SELECT * FROM `dvr_health_site_monthwise_new` ORDER BY `id` DESC LIMIT 1");
	 
	if(mysqli_num_rows($sql)){
		$sql_result = mysqli_fetch_assoc($sql);
		$last_month = $sql_result['month'];
		$next_month = $last_month + 1;
	}
	$month_name =  date("F", strtotime(date("Y") ."-". $next_month ."-01"));
			
	CloseCon($con);
?>
	 
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
                            <h6 class="card-title">Date : <?php echo date('d/m/Y');?></h6> 
                        </div> 
                        
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-3">
									  <div class="form-group">
										<label for="month">Select Month</label>  
										<select name="month" id="month" class="form-control form-control-sm col-sm-9">
											<option value="">Select</option> 
											<option value="<?php echo $next_month;?>"><?php echo $month_name;?></option>
										</select>
									  </div>
									</div>
									<div class="row">	
										<div class="col-sm-3">
										   <button class="btn btn-primary" id="Button" onclick="getDetails()">Show</button>
										   
										</div>
										<!--<a href="" class="btn btn-primary" id="Button">Clear</a>-->
										
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
		<script src="js/client_bank_circle_atmid.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!--<script src="js/penalty_site_insert.js"></script>-->
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
		  function getDetails()
			{
				var month = $('#month').val(); 
				$.ajax({
					url: "penalty_site_insert_tlb_ajax.php", 
					type: "POST",
					data: {month:month},
					success: (function (result) { debugger;
					   console.log(result);
					   var obj = JSON.parse(result);
					   $("#load").hide();
					   if(obj.code==200){
						   alert('Successfully added site in 2 tables for processing penalty in that month');
					   }
					})
				});
			}   
		
		</script>

    
    </body>
</html>

