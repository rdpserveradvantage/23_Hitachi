<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	<!-- Video.j -->
	<link href="vendors/video-js/video-js.css" rel="stylesheet"/>
	<!-- /Video.j -->
	  
	<style>
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
			width: 500px;  */
			height: 210px;
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
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row" style="min-height: 80vh;">
                            <div class="col-md-7 br">
                               								
									<div class="card" style="margin-bottom:10px;">
										<div class="card-body" id="alertclose">
										   <form>
										    <input type="hidden" name="panel_id" id="panel_id">
											<input type="hidden" name="alert_type" id="alert_type">
										    <div class="row">
											  <div class="col-md-4">
												<div class="form-group">
												  <div class="col-sm-12">
												    <input type="text" name="atm_id" id="atm_id" readonly placeholder="ATMID" style="width:100%;">
												  </div>
												</div>
											  </div>
											  <div class="col-md-8">
												<div class="form-group">
												  <div class="col-sm-12">
													<select class="form-control" id="alert_close_type" name="alert_close_type" onchange="setRemark(this.value);">
													   <option value="">Select Alert Close</option>
													   <option value="Alert Close">Alert Close</option>
													   <option value="Alert Close with ticket generate">Alert Close with ticket generate</option>
													  
													</select>
												  </div>
												</div>
											  </div>
											  
											</div>
										
										
											<div class="row" id="ticket_remarks" style="display:none;">
											  <div class="col-md-12">
												<div class="form-group">
												  <div class="col-sm-12">
													<input type="text" class="form-control" id="remarks" name="remarks" placeholder="remarks"/>
												  </div>
												</div>
											  </div>
											 </div>
											 <button type="submit" class="btn btn-primary mr-2 btn-success">Submit</button>
										   </form>
										</div>
									</div>		
							    	
                                <div class="accordion" id="accordion" role="tablist">
                                    
                                </div>
                            </div>
                            <div class="col-md-5">
							     <div class="row form-group">
                                    <div class="col-md-12 mb-2">
                                        <h5 class="text-white ">
                                            ATM ID
                                        </h5>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <select id="atmid" data-placeholder="Select ATMID ..." class="form-control" tabindex="1">
                                            
											
                                        </select>
                                    </div>-->
                                    <div class="col-md-6">
                                        <select id="camera" class="form-control" onchange="camera();">
                                            <option value="2">Camera 2</option>
											<option value="3">Camera 3</option>
											<option value="4">Camera 4</option>
                                        </select>
                                    </div>
                                </div>
                                <!--<div class="row form-group">
                                    <div class="col-md-12 mb-2">
                                        <h5 class="text-white ">
                                            Site Name : XYZ Delhi
                                        </h5>
                                    </div>
                                    <div class="col-md-1" style="cursor: pointer;">
                                        <i class="fa fa-th menu-icon fa-2x text-muted" id="sort4" onclick="chngeSort(4)">
                                        </i>
                                    </div>
                                    <div class="col-md-1" style="cursor: pointer;">
                                        <i class="fa fa-th-list menu-icon fa-2x text-white" id="sort12" onclick="chngeSort(12)">
                                        </i>
                                    </div>
                                    <div class="col-md-1" style="cursor: pointer;">
                                        <i class="fa fa-th-large menu-icon fa-2x text-muted" id="sort6" onclick="chngeSort(6)">
                                        </i>
                                    </div>
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-1">
                                        <lable class="text-white">
                                            Sort
                                        </lable>
                                    </div>
                                    <div class="col-md-4">
                                        <select class="form-control">
                                            <option value="">
                                                Name
                                            </option>
                                            <option value="">
                                                Time
                                            </option>
                                        </select>
                                    </div>
                                </div>-->
                                <div class="row">
                                    <div class="sortblock col-md-12 form-group">
                                        <div class="card form-group">
                                            <div class="card-header" id="cameraheading-1" role="tab">
                                                Camera 1
                                            </div>
                                            <div class="card-body">
											     <div class="video-container" id="camera1" style="background: black;max-height:40vh;">
                                    
                                                 </div>
                                                <!--<video class="video-js" controls="" data-setup="{}" height="auto" id="my-video" poster="" preload="auto" width="auto">
                                                    <source src="http://103.141.218.26:5020/?name=1" type="application/x-mpegURL">
                                                    </source>
                                                    <source src="media/sample.mp4" type="video/webm">
                                                    </source>
                                                </video>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="sortblock col-md-12 form-group">
                                        <div class="card">
                                            <div class="card-header" id="cameraheading-2" role="tab">
                                                Camera 2
                                            </div>
                                            <div class="card-body">
											    <div class="video-container" id="camera2" style="background: black;max-height:40vh;">
                                    
                                                 </div>
                                                
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
        <script src="js/todolist.js">
        </script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js">
        </script>
        <!-- End custom js for this page-->
        <!-- video.js -->
        <script src="vendors/video-js/video.min.js">
        </script>
        <!-- video.js -->
        <script>
		    $('#alertclose form').on('submit', function (e) {
               var atmid = $('#atm_id').val();
			   var alert_close_type = $('#alert_close_type').val();
			   var remarks = $('#remarks').val();
			   if(atmid==''){
				   alert("Atm ID must required.");
				   return false;
			   }
			   if(alert_close_type==''){
				   alert("Alert Close Type must required.");
				   return false;
			   }else{
				   if(alert_close_type=='Alert Close with ticket generate'){
					   if(remarks==''){
						   alert("Remarks must required.");
						   return false;
					   }
				   }
			   }
				  e.preventDefault();
				  $("#alertclose .btn-success").hide();
				  $.ajax({
					type: 'post',
					url: 'process_alert_close.php',
					data: $('#alertclose form').serialize(),
					success: function (msg) { debugger;
					if(msg=='0'){
						alert("Unable to Close Alert");
					}else{
						if(msg=='1'){
						alert("Alert Closed and Ticket Generated Successfully");
						}else{
						alert("Alert Closed Successfully");	
						}
					  window.location.href = "index.php";	
					}
					$("#alertclose .btn-success").show();
					
					}
				  });

			});
		     function setRemark(val){
				 if(val=="Alert Close with ticket generate"){
					 $("#ticket_remarks").css('display','block');
				 }
			 }
			 function setATMID(panelid,atmid,alerttype){
				 $('#atm_id').val(atmid);
				 $('#alert_type').val(alerttype);
				 $('#panel_id').val(panelid);
				 setcamera(atmid);
			 }
			 function setcamera(atmid){
				//var cam = $("#camera").val();
				//$(".video-container").html('');
				//$(".video-container").html('<iframe src="'+ cam + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
				if(atmid=='P3ENMM09'){
				  var cam1 = "http://103.141.218.26:5020/?name=1";
				  $("#camera1").html('<iframe src="'+ cam1 + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
		      //   var cam2 = "http://103.141.218.26:5020/?name=2";
			//	  $("#camera2").html('<iframe src="'+ cam2 + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
				  
				  $("#camera").html('<option value="http://103.141.218.26:5020/?name=2">Camera 2</option><option value="http://103.141.218.26:5020/?name=3">Camera 3</option><option value="http://103.141.218.26:5020/?name=4">Camera 4</option>');
				}
			}
			function camera(){
				var cam = $("#camera").val();
				$('#cameraheading-2').html('');
				var cam_heading= $("#camera option:selected").text();
				$('#cameraheading-2').html(cam_heading);
				$("#camera2").html('');
				$("#camera2").html('<iframe src="'+ cam + '" title="description" style="height: 40vh;width: 100%;"></iframe>');
			}
            function chngeSort(Value)
            {

                if (Value==4) 
                {

                $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-6');
                $('.sortblock').removeClass('col-md-12');

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');


                
                } 

                if (Value==6) 
                {
                     $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-12');
                // alert(Value);

                 $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort12').removeClass('text-muted');
                $("#sort12").addClass('text-white');

                } 

                if (Value==12) 
                {
                       $(".sortblock").addClass('col-md-'+Value);
                $('.sortblock').removeClass('col-md-4');
                $('.sortblock').removeClass('col-md-6');
                // alert(Value);

                $("#sort"+Value).addClass('text-muted');
                $("#sort"+Value).removeClass('text-white');

                $('#sort4').removeClass('text-muted');
                $("#sort4").addClass('text-white');
                $('#sort6').removeClass('text-muted');
                $("#sort6").addClass('text-white');
                }

                
            }
        </script>
		<script>
    function dashboard_panel() {
		$.ajax({
			url: "dashboard_panel.php", 
			success: (function (result) {
				// $("#div1").html(result);
				$("#accordion").html(result);
				atm_panel();
			})
		})
	};
	
	function alerts_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
				//atm_panel();
			})
		})
	};
	
	function alerts_panel_refresh(panelid) {
		$.ajax({
			type: "POST",
			url: "alerts_panel_refresh.php", 
			data: {panelid:panelid},
			success: (function (result) {
				// $("#div1").html(result);
				$("#"+panelid).html(result);
				//atm_panel();
			})
		})
	};
	
	function search_panel(panelid) {
		$.ajax({
			type: "POST",
			url: "search_dashboard_panel.php", 
			data: {panelid:panelid},
			success: (function (result) { debugger;
				// $("#div1").html(result);
				$("#accordion").html(result);
				alerts_panel(panelid);
			})
		})
	};
	var countload = 0;
	var atmid_array = [];
	function atm_panel() { debugger;
		$.ajax({
			url: "atm_panel.php", 
			dataType: "json",
			success: (function (result) { 
			    var res = result.atmid;
				if(res.length>atmid_array.length){
					dashboard_panel();
					var data = '<option value="" data-id="all">Select Atm ID</option>';
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						
					  data += '<option value="'+arrdata[0]+'" data-id="'+arrdata[1]+'">'+arrdata[0]+'</option>';
					  if(!atmid_array.includes(arrdata[0])){
						atmid_array.push(arrdata[0]);
						var j = i+1;
						
					  }
					  if(countload==0){
					   alerts_panel(arrdata[1]);
					   countload=1;
				      }else{
					   alerts_panel_refresh(arrdata[1]);	
                      }					   
					}
				 //  $("#atmid").html(data);
				}else{
					for(var i=0;i<res.length;i++){
						var arrdata = res[i].split("_");
						if(countload==0){
						   alerts_panel(arrdata[1]);
						   countload=1;
						  }else{
						   alerts_panel_refresh(arrdata[1]);	
						  }	
					}
				}
			    var res2 = JSON.stringify(result);
			    
			  // addatm(j,'AZX1233');
				//$("#accordion").html(result);
			})
		})
	};
	function addatm(j,atmid){
		var html = '<div class="card"><div class="card-header" id="heading-'+j+'" role="tab">';
		html += '<h6 class="mb-0"><a aria-controls="collapse-'+j+'" aria-expanded="false" class="collapsed" data-toggle="collapse" href="#collapse-'+j+'">';
		html += j+". "+atmid;
		html += '</a></h6></div>';
	    html += '<div aria-labelledby="heading-'+j+'" class="collapse" data-parent="#accordion" id="collapse-'+j+'" role="tabpanel">';
		html += '<div class="card-body"></div></div>';
		$("#accordion").append(html);
	}

	dashboard_panel(); // To output when the page loads
	//atm_panel();
	setInterval(atm_panel, (10000)); // x * 1000 to get it in seconds


   $("#atmid").on("change",function(){
	   var panelid = $(this).children('option:selected').data("id");
	   if(panelid=='080431'){
		   
}else if(atm=='ATM2'){

$("#camera").html('<option value="">Select</option><option value="http://103.72.141.218:5020/?name=4">Camera 1</option>');

    }
	  // alert(panelid);
	   if(panelid=="all"){
		  window.location = "index.php";
	   }
	   search_panel(panelid);
   })

</script>
    </body>
</html>
