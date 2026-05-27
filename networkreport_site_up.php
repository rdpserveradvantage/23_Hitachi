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
                         <h6 class="card-title">Site Network report Update</h6> 
                          <?php //include('filters/sitehealth_filter.php');?>
						</div> 
                        
						<div class="card" id="filter">
							<div class="card-block">
								<form action="<? echo $_SERVER['PHP_SELF']; ?>" method="POST">
									<div class="row">
									    <div class="col-md-4">
										<label>ATM ID</label>
                                            <div class="input-group input-group-button">
                                                 <select class="form-control js-example-basic-single w-100" id="atmid" name="atmid" required>
                                                <option value="">Select ATM ID</option>
                                                    <?php  $atm_sql = mysqli_query($con,"SELECT ATMID FROM `sites` WHERE live='Y'");
                                                       while($atm_sql_result = mysqli_fetch_assoc($atm_sql)){  ?>
                                                          <option value="<?php echo $atm_sql_result['ATMID']; ?>">
                                                       <?php  echo $atm_sql_result['ATMID']; ?>
                                                    </option> 
                                                       <?php } ?>
                                              </select>
                                            </div>
                                        </div>
										<div class="col-md-3">
											<label>DateTime</label>
										
											<input type="datetime-local" class="form-control" name="datetime" id="datetime">
										</div>
									</div>
									<div class="col" style="display:flex;justify-content:center;">
										<input type="submit" id="submit" name="submit" value="Update" class="btn btn-primary"> </div>
								</form>
								<!--Filter End -->
								<hr> </div>
						</div>  

                        <?php 
					   $updatekey = 0;
					   if(isset($_POST['submit'])){
					       
					       $atmid = $_POST['atmid'];
					       $datetime = $_POST['datetime'];
					       $receivedtime = str_replace('T',' ',$datetime);
					       
					       //var_dump($receivedtime);echo "<br>";
                            $userid = $_SESSION['userid']; 
                            
            		        $qry = mysqli_query($con,"SELECT SN FROM `sites` WHERE ATMID = '".$atmid."' ");
                         
                            if(mysqli_num_rows($qry)){
                            while($sitesql_result = mysqli_fetch_assoc($qry)){
            			    $SN = $sitesql_result['SN'];
                    			    $updatesql= " UPDATE `network_report_com` SET `router`='".$receivedtime."',`dvr`='".$receivedtime."',`panel`='".$receivedtime."' where `SN`='".$SN."'";
                    				$month_result = mysqli_query($con,$updatesql);
                    				if($month_result){
                    				   // up network site
                    				   $update_network_list = mysqli_query($con,"update `network_report_list_com` set `router_status` = 1,`panel_status` = 1,`dvr_status` = 1,`router_lastcommunication` = '".$receivedtime."',`dvr_lastcommunication` = '".$receivedtime."',`panel_lastcommunication` = '".$receivedtime."' where `ATMID` = '".$atmid."' "); 
                        				if($update_network_list){
                        				    $updatekey = $updatekey + 1;  
                        				    echo 'ATMID '.$atmid.' updated its value.';
                        				}
                    				}
                                }
                            }
                        
                
                        }else { }
					  if($updatekey>0){ ?>
                                <script>
                                    var key = <?php echo $updatekey;?>;
                                    alert("Total no of rows updated : "+key);</script>
                       <?php } ?>
					   						
                       
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
        <!-- <script src="js/networkreport_1.js"></script> -->
		<script src="js/networkreport_1_new.js"></script>
        <script src="js/data-table.js"></script>
         <script src="js/select2.js"></script>
        <!-- End custom js for this page-->
        <script>
		  $(document).on("click", ".large-modal", function () {
			 var src = $(this).data('id');
			 $(".modal-body #img_src").prop('src',src );
			 
		});
		
		</script>

    
    </body>
</html>
