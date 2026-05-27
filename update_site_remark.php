<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    
		$con = OpenCon();
		$id=$_GET['id'];
		$sql=mysqli_query($con,"select * from sites where SN='".$id."'");
		$sql_result=mysqli_fetch_assoc($sql);
		$SN= $sql_result['SN'];
		$atmid = $sql_result['ATMID'];
		
		$sql_remark=mysqli_query($con,"select * from site_details_remark where SN='".$id."'");
		$site_remark = '';
		$is_insert = 1;
		if(mysqli_num_rows($sql_remark)>0){
		   $sql_remark_result=mysqli_fetch_assoc($sql_remark);
		   $site_remark = $sql_remark_result['remarks'];
		   $is_insert = 0;
		}
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
			overflow-y: scroll;
			text-align:justify;  */
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
                        <div class="col-md-6 grid-margin stretch-card">
							  <div class="card">
								<div class="card-body">
								  <h4 class="card-title">Upload Site Remark</h4>
								  <form id="form" method="POST" action="process_update_remarks.php" enctype="multipart/form-data">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
											  <label class="col-form-label">ATMID</label>
											  <div class="col-sm-9">  <!--<?//=$ATMID?> -->
												<input type="text" class="form-control" value="<?php echo $atmid;?>" name="atmid" id="ATMID" readonly>
											  </div>
											</div>
										</div>
									</div>
									
									<div class="row">
								       <div class="col-md-12">
										<div class="form-group">
										  <label class="col-form-label">Site Remark</label>
										  <div class="col-sm-12">
											<textarea rows="4" cols="25" id="site_remark" name="remarks" class="form-control"><?php echo $site_remark;?></textarea>
										  </div>
										</div>
									  </div>
									</div>
									
                						
								        
										<div  class="col-sm-12">
                						    <br><input type="hidden" id="SN" name="SN" value="<?php echo $SN;?>">
											<input type="hidden" id="is_insert" name="is_insert" value="<?php echo $is_insert;?>">
                						    <input id="submit_btn" type="submit" name="submit" value="submit" class="btn btn-success">
                						</div>
								     </form>
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
        <script src="vendors/video-js/video.min.js">
        </script>
    

    </body>
</html>
