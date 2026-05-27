<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	
	<style>
		.bt{
				border-top: 1px solid #1e1f33;
		  }
		  .br
		  {
				border-right: 1px solid #282844;
		  }
		   div.card-body.table {
		/*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px; 
			height: 210px;  
			overflow-x: hidden;
			overflow-y: scroll;
			text-align:justify; */
			overflow-x: scroll;
		}
	</style>
	<style>
		.menu-icon
		{
			width: 33px;
			margin-right: 7%;
		}
	</style>
	<link href="plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link href="plugins/clockpicker/css/bootstrap-clockpicker.min.css" rel="stylesheet">
	<link href="plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">                 
     <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
                <div class="main-panel">
                    <div class="content-wrapper">
										<div class="col-12 grid-margin">
                        
			                            </div>   		
						<div class="col-12 grid-margin">
						   <h3 class="card-title">Download Image In Zip Based on Date and Time(In Hour)</h3>
                            <div class="card">
                                <div class="card-body">
                <!-- Page-Title -->
                                   <!-- <form method="POST" action="downloadzip.php"> --->
									    
                                        <div class="row">
                                            
										    <div class="col-md-4"> 
												   <div class="form-group">
														<label>Date</label>
														<div>
															<div class="input-group">
																<input type="text" class="form-control" placeholder="mm/dd/yyyy" id="S_date" name="S_date" value="" required>
																<div class="input-group-append">
																	<span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
																</div>
															</div>
														</div>
													</div>
											</div>
                                          <!--
											<div class="col-md-4"> 
												<div class="form-group">
												<label>From Time</label>
												<div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
													<input type="text" class="form-control" id="From_timePicker" name="From_timePicker" value="">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-clock"></i></span>
													</div>
												</div>
											    </div>
											</div>  -->
											
											<div class="col-md-4"> 
												<div class="form-group">
												<label>From Time</label>
												<div class="input-group" data-placement="bottom" data-align="top" data-autoclose="true">
													<input type="text" class="form-control timepicker" id="From_timePicker" name="From_timePicker" value="">
													<div class="input-group-append">
														<span class="input-group-text"><i class="mdi mdi-clock"></i></span>
													</div>
												</div>
											    </div>
											</div>


											              
											
                                        </div>
                                    <!--</form>-->
                                         <div class="row">
											   <div class="col-md-4"> 
															<!--<input type="button" name="download" value="Search" class="btn btn-primary"  style="margin-top: 30px;">
														   --><button class="btn btn-primary" id="show_detail" onclick="get_Detail()">Search</button>
														</div>
											   <div class="col-md-4"> 
											      <a class="btn btn-danger" id="dwnld" style="display:none;" href="house-keeping.zip" download>Download zip</a>
											  </div>
											  <div class="col-md-4"> 
											      <a class="btn btn-info" id="dwnld_excel" style="display:none;" href="download_excel_report.php">Download Excel Report</a>
											  </div>
										 </div>
                                </div>

                                
								</div>
						  </div>
						</div>
					</div>
				 </div>


    <?php include('footer.php');?>
     <script src="vendors/js/vendor.bundle.base.js"></script>
     <script src="vendors/js/vendor.bundle.addons.js"></script>
     <script src="js/off-canvas.js"></script>
     <script src="js/hoverable-collapse.js"></script>
     <script src="js/misc.js"></script>
     <script src="js/settings.js"></script>
     <script src="js/todolist.js"></script>
	
      <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>



        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css" />

        <!-- jQuery  -->
     <!--   <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/js/waves.js"></script>
        <script src="../../assets/js/jquery.slimscroll.js"></script>-->

        <!-- plugin js -->
        <!--<script src="../../plugins/moment/moment.js"></script>-->
        <script src="plugins/bootstrap-timepicker/bootstrap-timepicker.js"></script>
       <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
       <script src="plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
        <!--   <script src="../../plugins/bootstrap-daterangepicker/daterangepicker.js"></script>-->
      <script src="plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

      

<script>
jQuery(document).ready(function () {

   // Date Picker
   jQuery('#S_date').datepicker({
        autoclose: true,
        todayHighlight: true
    });


    //Clock Picker
    $('.clockpicker').clockpicker({
        donetext: 'Done'
    });

    $('.timepicker').timepicker({
		timeFormat: 'H:mm',
		interval: 60,
		minTime: '0',
		maxTime: '23',
		defaultTime: '0',
		startTime: '1:00',
		dynamic: false,
		dropdown: true,
		scrollbar: true
	});
	
});

function get_Detail(){ debugger;
	        var S_date = $("#S_date").val();
			var From_timePicker = $("#From_timePicker").val();
			if(S_date!='' && From_timePicker!=''){
				$("#load").show();
				$.ajax({
							url: "downloadzip.php", 
							type: "POST",
							data: {S_date:S_date,From_timePicker:From_timePicker},
							success: (function (result) { debugger;
							    $("#load").hide(); 
							    if(result==200){
									$('#dwnld').css('display','block');
									$('#dwnld_excel').css('display','block');
								}else{
									
								}
							})
				});
			}
	}

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    </body>
</html>

  







      
