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
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">AtmID</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" readonly name="atmid" id="atmid" value="<?php echo $_resultdata['atmid'];?>" />
					  </div>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Card Number</label>
					  <div class="col-sm-9">
						<input type="number" class="form-control" readonly name="cardno" id="cardno" value="<?php echo $_resultdata['card_no'];?>" />
					  </div>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Date Of TXN</label>
					  <div class="col-sm-9">
                    	<input type="date" class="form-control" readonly name="dateoftxn" id="dateoftxn" value="<?php echo $_resultdata['date_of_TXN'];?>" />
					  </div>
					</div>
				  </div>
				</div>
				<div class="row">

				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Time of TXN</label>
					  <div class="col-sm-9">
						<input type="time" class="form-control" readonly name="timeoftxn" id="timeoftxn" value="<?php echo $_resultdata['time_of_TXN'];?>" />
					  </div>
					</div>
				  </div>

				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Nature of TXN</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control"  readonly name="natureoftxn" id="natureoftxn" value="<?php echo $_resultdata['nature_of_TXN'];?>" />
					  </div>
					</div>
				  </div>
				   <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Amount of TXN</label>
					  <div class="col-sm-9">
						<input type="text" class="form-control" readonly name="amountoftxn" id="amountoftxn" value="<?php echo $_resultdata['amount_of_TXN'];?>" />
					  </div>
					</div>
				  </div>

				</div>
				<div class="row">

				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">TXN Number</label>
					  <div class="col-sm-9">
						<input type="number" class="form-control" readonly name="txnnumber" id="txnnumber" value="<?php echo $_resultdata['txn_no'];?>" />
					  </div>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Complaint Number</label>
					  <div class="col-sm-9">
						<input type="number" class="form-control" readonly name="complaint_no" id="complaint_no" value="<?php echo $_resultdata['complaint_no'];?>" />
					  </div>
					</div>
				  </div>
				  <div class="col-md-4">
					<div class="form-group row">
					  <label class="col-sm-3 col-form-label">Complaint Date</label>
					  <div class="col-sm-9">
						<input type="date" class="form-control" readonly name="complaint_date" id="complaint_date" value="<?php echo $_resultdata['complaint_date'];?>" >
					  </div>
					</div>
				  </div>
				</div>

				<div class="row">

					 <div class="col-md-4">
						<div class="form-group row">
						  <label class="col-sm-3 col-form-label">Claim Date</label>
						  <div class="col-sm-9">
							<input type="date" class="form-control" readonly name="claim_date" id="claim_date" value="<?php echo $_resultdata['claim_date'];?>" >
						  </div>
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
				  
                    <div class="row">

						 <div class="col-md-4">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage Availability</label>
							    <div class="col-sm-9">
								    <select name="footage_avail" id="footage_avail" class="form-control" onchange="available()">
									    <option value="">Select</option>
										<option value="Yes" <?php if($_resultdata['footage_avail']=='Yes'){ echo 'selected';}?>>Yes</option>
										<option value="No" <?php if($_resultdata['footage_avail']=='No'){ echo 'selected';}?>>No</option>
									</select>
								</div>
							</div>
						  </div>
						  
						  <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage Filename</label>
							    <div class="col-sm-9">
								    <input type="text" name="footage_filename" value="<?php echo $_resultdata['footage_filename'];?>" class="form-control" >
								</div>
							</div>
						  </div>
						  
						   <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
								<div class="form-group row">
								  <label class="col-sm-3 col-form-label">Footage Date</label>
								  <div class="col-sm-9">
									<input type="date" class="form-control" name="footage_date" id="footage_date" value="<?php echo $_resultdata['footage_date'];?>" >
								  </div>
								</div>
							</div>
					</div> 	

                    <div class="row">

						 <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage Start Time</label>
							    <div class="col-sm-9">
								    <input type="time" class="form-control" name="footage_start_time" id="footage_start_time" value="<?php echo $_resultdata['footage_start_time'];?>" />
					            </div>
							</div>
						  </div>
						  
						  <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Footage End Time</label>
							    <div class="col-sm-9">
								    <input type="time" class="form-control" name="footage_end_time" id="footage_end_time" value="<?php echo $_resultdata['footage_end_time'];?>" />
								</div>
							</div>
						  </div>
						  
						   <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
								<div class="form-group row">
								  <label class="col-sm-3 col-form-label">Date Of Preservation</label>
								  <div class="col-sm-9">
									<input type="date" class="form-control" name="date_of_presrv" id="date_of_presrv" value="<?php echo $_resultdata['date_of_presrv'];?>" >
								  </div>
								</div>
							</div>
					</div> 	

                    <div class="row">
					    <div class="col-md-4 <?php if($_resultdata['footage_avail']=='No'){ echo 'hide';}?> available">
                        <div class="form-group row">
						  <label class="col-sm-3 col-form-label">Url Link Download</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="downlink" id="downlink" value="<?php echo $_resultdata['downlink'];?>" >
						  </div>
						</div>  
						</div>
                    </div> 					
                   
                    
                </div>
              </div>
            </div>

          </div>
		  
		  <?php if($_resultdata['status']==1){ ?>
		    <form id="form" method="POST" action="footage_request_process_finalupdate.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
					<div class="row">
					      <div class="col-md-4">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Update Status</label>
							    <div class="col-sm-9">
								    <select name="status" id="status" class="form-control" >
									    <option value="">Select</option>
										<option value="2">Closed</option>
										<!--<option value="0">Pending</option>-->
									</select>
								</div>
							</div>
						  </div>
					</div>	  
			        <button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                    <!--<button class="btn btn-light">Cancel</button>-->
            </form>	
		  <?php }else{ ?>	
            		 <div class="row">
					      <div class="col-md-4">
							<div class="form-group row">
							  <label class="col-sm-3 col-form-label">Status</label>
							    <div class="col-sm-9">
								    <select name="status" id="status" class="form-control" >
									    <option value="">Select</option>
										<option value="2" <?php if($_resultdata['status']=='2'){ echo 'selected';}?>>Closed</option>
										<option value="1" <?php if($_resultdata['status']=='1'){ echo 'selected';}?>>Processing</option>
										<option value="0" <?php if($_resultdata['status']=='0'){ echo 'selected';}?>>Pending</option>
									</select>
								</div>
							</div>
						  </div>
					</div>	
          <?php }?>					
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

