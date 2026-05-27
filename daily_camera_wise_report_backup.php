<!DOCTYPE html>
<html lang="en">
    <?php   include('head.php');
	        $list=array();$list1=array();
			$month = date('m');
			$year = date('Y');

			for($d=1; $d<=31; $d++)
			{
				$time=mktime(12, 0, 0, $month, $d, $year);          
				if (date('m', $time)==$month){       
					$list[]=date('Y-m-d-D', $time);
					$list1[]=date('Y-m-d', $time);
				}
			}
 
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
                         <h6 class="card-title">Daily Camera Wise Report As on Date : <?php echo date('d/m/Y');?></h6> 
                          <?php include('filters/daily_camera_wise_report_filter.php');?>
						</div> 
                        <!-- Dashboard Wighets -->
						
                        <!-- Dashboard Charts -->
						
						<div class="card">
                            <div class="card-body">
								<div class="row">
									<div class="col-12" id="ticketview_tbody">
									  <div class="table-responsive">
									  <!--
									    <table id="example" class="table"></table>
										
										<table id="example1" class="table"></table> -->
									  
										<table id="order-listing" class="table">
										  <thead>
											<tr>
												<th>S.N</th><th>Date</th>
												<th>ATM-ID</th><th>Circle</th><th>ZO</th>
												<th>State</th>
												<th>Location</th>
												<th>Site Type</th>
												<th>Camera</th>
												<th>Date 1 (Up in Hrs & Min)</th>
												<th>Date 2 (Up in Hrs & Min)</th>
												<th>Date 3 (Up in Hrs & Min)</th>
												<th>Date 4 (Up in Hrs & Min)</th>
												<th>Date 5 (Up in Hrs & Min)</th>
												<th>Total Up in Hrs</th>
												<th>Total Down in Hrs</th>
												  
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
        <script src="js/daily_camera_wise_report.js"></script>
        <script src="js/data-table.js"></script>
		<script src="js/dataTables.rowsGroup.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	
			
	<script>
						$(function() {

							var start = moment().subtract(30, 'days');
							var end = moment();

				function cb(start, end) {
					$('#reportrange span').html(start.format('MMM DD,YYYY') + ' - ' + end.format('MMM DD,YYYY'));
					$("#start").val(start.format('YYYY-MM-DD'));
					$("#end").val(end.format('YYYY-MM-DD'));
				   // get_ticketview();
				}

				$('#reportrange').daterangepicker({
					startDate: start,
					endDate: end,
					"showDropdowns": true,
					"autoApply": true,
					 maxDate: new Date(),
					ranges: {
					   'Today': [moment(), moment()],
					//   'Yesterday': [moment().subtract(1, 'days'), moment()],
					   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
					   'Last 7 Days': [moment().subtract(7, 'days'), moment()],
					   'Last 30 Days': [moment().subtract(30, 'days'), moment()],
					 //  'This Month': [moment().startOf('month'), moment().endOf('month')],
					 //  'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
					}



				}, cb);

				cb(start, end);


			});
			/*
			$(document).ready( function () {
  var data = [
    ['1', 'David', 'Maths', '80'],
    ['1', 'David', 'Physics', '90'],
    ['1', 'David', 'Computers', '70'],
    ['2', 'Alex', 'Maths', '80'],
    ['2', 'Alex', 'Physics', '70'],
    ['2', 'Alex', 'Computers', '90'],
  ];
  var table = $('#example').DataTable({
    columns: [
        {
            name: 'first',
            title: 'S.No.',
        },
        {
            name: 'second',
            title: 'ATM-ID',
        },
		
        {
            title: 'Subject',
        }, 
        {
            title: 'Marks',
        },
    ],
    data: data,
    rowsGroup: [
      'first:name',
      'second:name'
    ],
    pageLength: '20',
    });
} ); */
	</script>

		
        <script>
		  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});
		
		</script>
    
    </body>
</html>
