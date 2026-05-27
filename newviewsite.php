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
		   div.card-body {
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
                            
     <?php include('top-navbar.php');?>
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
				
				<?php 
                    include('panel_health_data.php');
                 ?>
				 
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="page-header">
																							
							<h3 class="page-title" style="color:#fff;">
							  View Site
							</h3>
							
							<!--<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Tables</a></li>
								<li class="breadcrumb-item active" aria-current="page">Data table</li>
							  </ol>
							</nav>-->
						  </div>
								<div class="col-12 grid-margin">
									<div class="card">
										<div class="card-body">
										  
										  <form class="form-sample" id="forms" action="viewsite_process.php" method="POST" enctype="multipart/form-data">
											
											<div class="row">
											 
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Status</label>
												  <div class="col-sm-9">
													<select class="form-control" name="Status" id="Status">
														<option value=""> Select</option>
														<option value="Y" selected> Active</option>
														<option value="N">In Active</option>
														<option value="P">Pending</option>
														<option value="T">Testing</option>
														<option value="PL">Partial Live</option>
													</select>
												  </div>
												</div>
											  </div>
											  
											</div>
											<div class="row">
											
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">ATMID</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="ATMID" id="ATMID" onblur="checkpanel()">
												  </div>
												</div>
											  </div>
											
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">Tracker No</label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="TrackerNo" id="TrackerNo" value="-" />
												  </div>
												</div>
											  </div>
											  
											   
											</div>
											
											
											<div class="row">
											  
											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label">DVR IP </label>
												  <div class="col-sm-9">
													<input type="text" class="form-control" name="DVRIP" id="DVRIP" onblur="checkip()"/>
												  </div>
												</div>
											  </div>

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label"> From LiveData  </label>
												  <div class="col-sm-9">
													<input type="date" id="F_date" name="F_date"/>
												  </div>
												</div>
											  </div>

											  <div class="col-md-4">
												<div class="form-group row">
												  <label class="col-sm-3 col-form-label"> To LiveData  </label>
												  <div class="col-sm-9">
													<input type="date" id="T_date" name="T_date"/>
												  </div>
												</div>
											  </div>
											
											</div>
									</div>							  

											<button type="submit" name="sub"  class="btn btn-primary mr-2" style="float:right" onclick="a('','')">Submit</button>
											<!-- <button class="btn btn-light" style="float:right">Cancel</button> -->
										  </form>
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
		<script src="js/data-table.js"></script>
        <!-- End custom js for this page-->
				<script src="newsite.js">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		
            function a(strPage,perpg){
               //var Zone1=document.getElementById("Zone").value;
           // alert(bid);
               var DVRIP=document.getElementById("DVRIP").value;
           // alert(bname);
            var atmid=document.getElementById("atmid").value;
            // var DVRName=document.getElementById("DVRName").value;
            // alert(subject);
             // var ATMShortName=document.getElementById("ATMShortName").value;
			  var project=document.getElementById("project").value;
			  var lstatus=document.getElementById("lstatus").value;
			  var cssbm=document.getElementById("cssbm").value;
			  var cust=document.getElementById("cust").value;
			  var track=document.getElementById("track").value;
			  var cities=document.getElementById("cities").value;
			  var F_date=document.getElementById("F_date").value;
			  var T_date=document.getElementById("T_date").value;
			
             perp='2100';

  var Page="";
  if(strPage!="") 

  {
  Page=strPage;
  }
   $('#loadingmessage').show();  // show the loading message.

              
             $.ajax({
               
            type:'POST',    
   url:'viewsite_process.php',
   data:'DVRIP='+DVRIP+'&atmid='+atmid+'&track='+track+'&lstatus='+lstatus+'&cssbm='+cssbm+'&cust='+cust+'&cities='+cities+'&Page='+Page+'&perpg='+perp+'&project='+project+'&F_date='+F_date+'&T_date='+T_date,


   success: function(msg){
    
   $('#loadingmessage').hide(); // hide the loading message
   document.getElementById("show").innerHTML=msg;
    
  } })
            }


    </body>
</html>
