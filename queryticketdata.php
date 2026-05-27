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
    th, td {
			white-space: nowrap;
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
					<h3 class="card-title" >Query Ticket</h3>

                    <?php include("filters/queryticket_filter.php");?>
          <div class="card">
            <div class="card-body">
              <h4 class="card-title" >Ticket View Details:</h4>
              <div class="row" style="margin-bottom:10px;">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                <div id="reportrange" class="form-control"   data-cancel-class="btn-light"  style="float:right;">
                              <i class="fa fa-calendar"></i>&nbsp;
                              <span id="selectedValue"></span> 
                          </div>

                          <input type="hidden" id="start" name="start" value="<?php echo date('Y-m-d');?>">
                          <input type="hidden" id="end" name="end" value="<?php echo date('Y-m-d');?>">
                </div>	
              </div>
              
              <div class="row">
                <div class="col-12" id="queryticket_tbody">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
                            
							<th>ID</th>
                            <th>Location</th>
                            <th>Alert Type</th>
                            <th>Start DateTime</th>
                            <th>Status DateTime</th>
                            <th>DVR IP</th>
                            <th>Remark</th>
                            <th>Ticket ID</th>
                            <th>Action</th>
							<th>Closed By</th>                           
                        </tr>
                      </thead>
                      <tbody >
                        
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
                get_queryticket();
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
		<script src="js/queryticket.js"> 
		</script>
		<script src="js/data-table.js">
		</script>

        <script> 
			onload();
		</script>

    </body>
</html>
