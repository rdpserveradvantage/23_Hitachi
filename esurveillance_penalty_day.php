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
                    <h2 class="card-title" >Esurveillance Penalty View</h2>
                    <?php include("filters/monthyear_filter.php");?>

          <div class="card">
            <div class="card-body">
              <h4 class="card-title" >Penalty Details </h4>
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
                            
							<th>ID</th>
                            <th>Location</th>
                            <th>ATMID</th>
							<th>Month</th>
							<th>Year</th>
                            <th>Total Down Time</th>
                            <th>Total Penalty Amount</th>
                            <th>Details</th>                           
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
		
<!-- Modal starts -->

<!-- large modal 
<div class="modal fade" id="myModalDetail" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">History Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>RNM Fund Request and Approve Details</h6>
          <div class="card">
            <div class="card-block" id="result_status" style=" overflow: auto;">
              
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
  -->
                  
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
							<!-- Modal heading -->
							<div class="modal-header">
								<h5 class="modal-title" 
									id="exampleModalLabel">
								  DownTime Details
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
								<h6>Up & Down Time Details</h6>
								  <div class="card">
									<div class="card-block" id="result_status" style=" overflow: auto;">
									  
									</div>
								</div>
							</div>
						</div>
                    </div>
                  </div>
                  <!-- Modal Ends -->
				  
		
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
        <script src="js/esurveillance_penalty_day.js"></script>
        <script src="js/data-table.js"></script>
		<script src="js/select2.js"></script>

        <script>
		 /* $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});*/
		$(document).on("click", ".large-modal", function () {
			 var Id = $(this).data('id');
			 
			 $.ajax({    //create an ajax request to display.php
				type: "GET",
				url: "down_time_details_day.php?id="+Id,             
				dataType: "html",   //expect html to be returned                
				success: function(response){                    
					$(".modal-body #result_status").html(response); 
					//alert(response);
				}
			 });
			// $(".modal-body #result_status").val( reqStatus );
		});
		</script>

    </body>
</html>
