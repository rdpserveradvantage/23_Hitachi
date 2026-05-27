<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   
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
                    <h2 class="card-title" >AI Ticket View</h2>
                    <?php include("filters/ticketview_filter.php");?>

          <div class="card">
            <div class="card-body">
              <h4 class="card-title" >Ticket View Details </h4>
			  <div class="row" style="margin-bottom:10px;">
			    <div class="col-md-6"></div>
			    <div class="col-md-6">
				    <div class="col-md-6"><span id="ready_to_export">Ready to Export</span></div>
				    <div class="col-md-6 hidden" id="export_to_excel">
				    <form action="aiticketexcel.php" method="POST">
						 <input type="hidden" name="ticket_ids" value="" id="ticket_ids">
						 <input type="hidden" name="excel_client" id="excel_client" value="">
						 <input type="hidden" name="excel_bank" id="excel_bank" value="">
						 <input type="hidden" name="excel_circle" id="excel_circle" value="">
						 <input type="hidden" name="excel_atmid" id="excel_atmid" value="">
						 <input type="hidden" name="excel_start" id="excel_start" value="<?php echo date('Y-m-d');?>">
						 <input type="hidden" name="excel_end" id="excel_end" value="<?php echo date('Y-m-d');?>">
						 <input type="hidden" name="excel_portal" id="excel_portal" value="all">
						 <input type="submit" value="Export to Excel All">
					 </form> 
					 </div>
				</div>
			      
			   </div>	 
               <div class="row">
                <div class="col-12" id="aiticketview_tbody">
                  <div class="table-responsive hidden">
                    <table id="example" class="table table-bordered table-striped table-hover dataTable js-exportable no-footer">
                      <thead>
                     
                        <tr>
                            
							<th>Ticket ID</th>
                            <th>Location</th>
                            <th>Branch Code</th>
                            <th>Alert Type</th>
                            <th>Ticket DateTime</th>
                            <th>DVR IP</th>
                            <th>Alarm Status</th>
                            <th> Action </th>                           
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
				  
		
        <script src="vendors/js/vendor.bundle.base.js">
        </script>
        <script src="vendors/js/vendor.bundle.addons.js">
        </script>
		
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
		
<script>
$("#export_to_excel").hide();
$(".dt-buttons").on("click", function() {
    alert("ok");
});
$("#ready_to_export").on("click", function(){
	$("#export_to_excel").show();
	$("#ready_to_export").hide();
	var arr = [];
	var elements = document.getElementsByClassName("sorting_1");
	/*for (var i = 0, len = elements.length; i < len; i++) {
		 var eleval = elements[i].html();
		 arr.push(eleval);
	}*/
	var inputs = $(".sorting_1");
	for(var i = 0; i < inputs.length; i++){
		var eleval =  $(inputs[i]).html();
		arr.push(eleval);
	}
	$("#ticket_ids").val(arr);
	//alert($("#ticket_ids").val());
});
		$(function() {

		   // var start = moment().subtract(30, 'days');
			var start = moment(); 
			var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMM DD,YYYY') + ' - ' + end.format('MMM DD,YYYY'));
                $("#start").val(start.format('YYYY-MM-DD'));
                $("#end").val(end.format('YYYY-MM-DD'));
				$("#excel_start").val(start.format('YYYY-MM-DD'));
                $("#excel_end").val(end.format('YYYY-MM-DD'));
               // get_ai_ticket();
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
			
			$('#reportrange').change(function(){ debugger;
				
			});


        });
</script>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
        <script src="js/dashboard.js"></script>
		<script src="js/client_bank_circle_atmid.js"></script>
        <script src="js/aiticket_1.js"></script>
        <script src="js/data-table.js"></script>
		<script src="js/select2.js"></script>

        <script>
		  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});
		</script>
		
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
