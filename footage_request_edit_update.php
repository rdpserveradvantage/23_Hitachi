<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');?>
	
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
		.hide{display:none;}
		.show{display:block;}
	</style>
     <?php include('top-navbar.php');?>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');
				   // include('db_connection.php');
				   $id = $_GET['id'];
				   $con = OpenCon();
                   $sql = mysqli_query($con,"select * from footage_request where id='".$id."'"); 
                   $_resultdata = mysqli_fetch_assoc($sql); 
				  // echo '<pre>';print_r($_resultdata);echo '</pre>';
                   CloseCon($con);				   
				?>
                <!-- partial -->
  <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
          <div class="center">
              
               <h3 class="page-title" >
                Footage Request
            </h3>
          </div>



            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav> -->
          </div>
        
          <div class="row">
		     
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
			  
			  <div class="card-body">
			    <h4 class="card-title">Footage Request Details</h4>
				
				
				
				<div class="row">

				  <div class="col-md-4">
				    <div class="form-group">
					  <label for="AtmID">AtmID</label>
					  <input type="text" readonly class="form-control" name="atmid" id="atmid" placeholder="AtmID" value="<?php echo $_resultdata['atmid'];?>">
					</div>
					
				  </div>
				  <div class="col-md-4">
				    <div class="form-group">
					  <label for="CardNumber">Card Number</label>
					  <input type="text" readonly class="form-control" name="cardno" id="cardno" placeholder="cardno" value="<?php echo $_resultdata['card_no'];?>">
					</div> 
					
				  </div>
				  <div class="col-md-4">
				    <div class="form-group">
					  <label for="DateOfTXN">Date Of TXN</label>
					  <input type="text" readonly class="form-control" name="dateoftxn" id="dateoftxn" placeholder="dateoftxn" value="<?php echo $_resultdata['date_of_TXN'];?>">
					</div> 
					
				  </div>
				</div>
				<div class="row">
                  
				  <div class="col-md-4">
					<div class="form-group">
					  <label for="TimeOfTXN">Time Of TXN</label>
					  <input type="text" readonly class="form-control" name="timeoftxn" id="timeoftxn" placeholder="timeoftxn" value="<?php echo $_resultdata['time_of_TXN'];?>">
					</div> 
				  </div>
				  
				  <div class="col-md-4">
					<div class="form-group">
					  <label for="StartTime">Start Time</label>
					  <input type="text" readonly class="form-control" name="start_time" id="start_time" placeholder="start_time" value="<?php echo $_resultdata['start_time'];?>">
					</div> 
				  </div>
				  
				  <div class="col-md-4">
					<div class="form-group">
					  <label for="EndTime">End Time</label>
					  <input type="text" readonly class="form-control" name="end_time" id="end_time" placeholder="end_time" value="<?php echo $_resultdata['end_time'];?>">
					</div> 
				  </div>
				</div>

				 
				<div class="row">
				  <div class="col-md-4">
					<div class="form-group">
					  <label for="NatureofTXN">Nature of TXN</label>
					  <input type="text" class="form-control"  readonly name="natureoftxn" id="natureoftxn" value="<?php echo $_resultdata['nature_of_TXN'];?>" />
					</div>
				  </div>
				  
				  <div class="col-md-4">
					<div class="form-group">
					  <label for="AmountofTXN">Amount of TXN</label>
					  <input type="text" class="form-control" readonly name="amountoftxn" id="amountoftxn" value="<?php echo $_resultdata['amount_of_TXN'];?>" />
					</div> 
				  </div>
					  
				  <div class="col-md-4">
				    <div class="form-group">
					  <label for="TXN_Number">TXN Number</label>
					  <input type="number" class="form-control" readonly name="txnnumber" id="txnnumber" value="<?php echo $_resultdata['txn_no'];?>" />
					</div>
					
				  </div>
				</div>
                <div class="row">      				
				  <div class="col-md-4">
				     <div class="form-group">
					  <label for="Complaint_Number">Complaint Number</label>
					  <input type="number" class="form-control" readonly name="complaint_no" id="complaint_no" value="<?php echo $_resultdata['complaint_no'];?>" />
					 </div> 
					
				  </div>
				  <div class="col-md-4">
				    <div class="form-group">
					  <label for="Complaint_Date">Complaint Date</label>
					  <input type="date" class="form-control" readonly name="complaint_date" id="complaint_date" value="<?php echo $_resultdata['complaint_date'];?>" >
					</div> 
					
				  </div>
				   <div class="col-md-4">
				        <div class="form-group">
						  <label for="Complaint_Date">Claim Date</label>
						  <input type="date" class="form-control" readonly name="claim_date" id="claim_date" value="<?php echo $_resultdata['claim_date'];?>" >
						</div>
						
				   </div>
				</div>

				
			  </div>
			  
			  </div>
			</div>
		</div>
			  
			  
		<div class="row">
		     
            <div class="col-md-12 grid-margin stretch-card">  
			  <div class="card">
                                   
                <div class="card-body">
                  <h4 class="card-title">Process Footage Request </h4>
				  <form id="form" method="POST" action="footage_request_process_edit_update.php" enctype="multipart/form-data">
                     <input type="hidden" name="id" value="<?php echo $id;?>">
                    <div class="row">

						 <div class="col-md-4">
						    <div class="form-group">
							  <label for="Footage_Availability">Footage Availability</label>
							  <select name="footage_avail" id="footage_avail" class="form-control" onchange="available()">
									<option value="">Select</option>
									<option value="Yes">Yes</option>
									<option value="No">No</option>
								</select>
							</div>
							
						  </div>
						   <div class="col-md-8 hide available">
								<div class="form-group">
								  <label for="Url_Availability">Url Link Download</label>
								  <input type="text" class="form-control" name="downlink" id="downlink" value="" >
								</div>  
							</div>
						  <!--
						  <div class="col-md-4 hide available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage Filename</label>
							    <div class="col-sm-9">
								    <input type="text" name="footage_filename" value="" class="form-control" >
								</div>
							</div>
						  </div>
						  
						   <div class="col-md-4 hide available">
								<div class="form-group row">
								  <label class="col-sm-3 col-form-label">Footage Date</label>
								  <div class="col-sm-9">
									<input type="date" class="form-control" name="footage_date" id="footage_date" value="" >
								  </div>
								</div>
							</div>-->
					</div> 	
                    <!--
                    <div class="row">

						 <div class="col-md-4 hide available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage Start Time</label>
							    <div class="col-sm-9">
								    <input type="time" class="form-control" name="footage_start_time" id="footage_start_time" value="" />
					            </div>
							</div>
						  </div>
						  
						  <div class="col-md-4 hide available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage End Time</label>
							    <div class="col-sm-9">
								    <input type="time" class="form-control" name="footage_end_time" id="footage_end_time" value="" />
								</div>
							</div>
						  </div>
						  
						   <div class="col-md-4 hide available">
								<div class="form-group row">
								  <label class="col-sm-3 col-form-label">Date Of Preservation</label>
								  <div class="col-sm-9">
									<input type="date" class="form-control" name="date_of_presrv" id="date_of_presrv" value="" >
								  </div>
								</div>
							</div>
					</div> -->	
                    <!--
                    <div class="row">
					    <div class="col-md-4 hide available">
                        <div class="form-group row">
						  <label class="col-sm-3 col-form-label">Url Link Download</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="downlink" id="downlink" value="" >
						  </div>
						</div>  
						</div>
                    </div> 	-->				
                   
                    <button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                    <!--<button class="btn btn-light">Cancel</button>-->
                  </form>
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
        <!--<script src="js/chart.js"></script>-->
        <!-- endinject -->
        <!-- Custom js for this page-->
        <script src="js/dashboard.js"></script>
        
        <!-- End custom js for this page-->
        <!-- video.js -->
       <!-- <script src="js/dvrdashboard.js"></script>-->
		<script src="js/select2.js"></script>
        <!-- video.js -->
       <script>
	        $("#AtmID").change(function(){
				var AtmID= $("#AtmID").val();
				$('#atmid').val(AtmID);
			});
			
function available() {
		var footage_avail = $("#footage_avail").val();
		if(footage_avail=='Yes'){
			$(".available").removeClass('show');
			$(".available").addClass('show');
		}else{
			$(".available").removeClass('show');
			$(".available").addClass('hide');
		}
		
	}


	   </script>
    
    </body>
</html>

