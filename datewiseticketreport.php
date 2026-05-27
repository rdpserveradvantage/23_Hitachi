<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    //include('config.php');
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
                    <h4 class="card-title" >Ticket View</h4>

                    <?php include("filters/ticketview_filter.php");?>
					
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Ticket Details From:</h4>
               <div class="row" style="margin-bottom:10px;">
			    <div class="col-md-6"></div>
			    <!--<div class="col-md-6">
			     <div id="reportrange" class="form-control"   data-cancel-class="btn-light"  style="float:right;">
                        <i class="fa fa-calendar"></i>&nbsp;
                        <span id="selectedValue"></span> 
                    </div>

                    <input type="hidden" id="start" name="start" value="<?php echo date('Y-m-d');?>">
                    <input type="hidden" id="end" name="end" value="<?php echo date('Y-m-d');?>">
			    </div>	-->
			   </div>
              
              <div class="row">
			    <div class="col-12">
				  <!-- <form action="ticketview_excel.php" method="post" target="_blank">
				      <input type="hidden" id="start_date" name="start" value="<?php echo date('Y-m-d');?>">
                      <input type="hidden" id="end_date" name="end" value="<?php echo date('Y-m-d');?>">
					  <input type="hidden" id="excel_client" name="client" value="" required>
                      <input type="hidden" id="excel_bank" name="bank" value="">
					  <input type="hidden" id="excel_atmid" name="atmid" value="">
                      <input type="hidden" id="excel_portal" name="portal" value="all">
					  <button type="submit" name="submit" class="primary">All Export to Excel</button>
				   </form>
				</div> -->
                <div class="col-12" id="ticketview_tbody">
                  <div class="table-responsive hidden">
                   
					                    <table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="example">
                                            <thead>
                                                <tr>
													<th>S.N</th><th>Date</th>
													<th>ATM-ID</th><th>Circle</th><th>Region</th>
													<th>State</th>
													<th>Location</th>
													<th>Event Occurrence</th>
													<th>Event Closure Time</th>
													<th>Nature of Alarm</th>
													<th>Total time taken to close</th>
													<th>Whether 2-way audio used</th>
													<th>Operator Comments</th> 
                                                </tr>
                                            </thead>
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
$(".dt-buttons").on("click", function() {
    alert("ok");
});
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
		
</script>

        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
		<script src="js/datewiseticketreport.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
      <script>
      // $(document).ready(function(){
		  function newexportaction(e, dt, button, config) {
			 // $("#load").show();
			 var that = this;
			/*  swal("Great!", "Export to Excel is processing...... Please Wait.", "success");

			   setTimeout(function(){ 
			   }, 1000); */
			 var self = this;
			 var oldStart = dt.settings()[0]._iDisplayStart;
			 dt.one('preXhr', function (e, s, data) {
				 // Just this once, load all data from the server...
				 data.start = 0;
				 data.length = 2147483647;
				 dt.one('preDraw', function (e, settings) {
					 // Call the original action function
					 if (button[0].className.indexOf('buttons-copy') >= 0) {
						 $.fn.dataTable.ext.buttons.copyHtml5.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-excel') >= 0) {
						 $.fn.dataTable.ext.buttons.excelHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.excelFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-csv') >= 0) {
						 $.fn.dataTable.ext.buttons.csvHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.csvFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-pdf') >= 0) {
						 $.fn.dataTable.ext.buttons.pdfHtml5.available(dt, config) ?
							 $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config) :
							 $.fn.dataTable.ext.buttons.pdfFlash.action.call(self, e, dt, button, config);
					 } else if (button[0].className.indexOf('buttons-print') >= 0) {
						 $.fn.dataTable.ext.buttons.print.action(e, dt, button, config);
					 }
					 dt.one('preXhr', function (e, s, data) {
						 // DataTables thinks the first item displayed is index 0, but we're not drawing that.
						 // Set the property to what it was before exporting.
						 settings._iDisplayStart = oldStart;
						 data.start = oldStart;
					 });
					 // Reload the grid with the original page. Otherwise, API functions like table.cell(this) don't work properly.
					 setTimeout(dt.ajax.reload, 0);
					 // Prevent rendering of the full data to the DOM
					 return false;
				 });
			 });
			 // Requery the server with the new one-time export settings
			 dt.ajax.reload();
			 $("#load").hide();
		 } 
	 //  });
      </script>
        
    </body>
</html>
