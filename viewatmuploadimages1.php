<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
	//include('db_connection.php');
   // session_start();
	$_user_id = $_SESSION['access'];
	$atmid = $_GET['atmid'];
	$con = OpenCon();
	$sql = mysqli_query($con,"select id,atmid,link from atm_upload_images where atmid='".$atmid."'");
	  
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
			overflow-y: scroll;*/
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
                    
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">View ATM Uploaded Images</h4>
			  <?php if($_user_id==1){ ?>
              <div class="row">
                <div class="col-12" id="ticketview_tbody">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
						    
                            <!--<th>Action</th>-->
							
							<th>ATMID</th>
							<th>Uploaded Image</th>
                            
							<th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					    <?php if(mysqli_num_rows($sql)){
		                         while($sitesql_result = mysqli_fetch_assoc($sql)){ 
								   $_atmid = $sitesql_result['atmid'];
								    $_id = $sitesql_result['id'];
									 $_link = $sitesql_result['link'];
								 ?>
									 <tr>
									    <td><?php echo $sitesql_result['atmid'];?></td>
										 <td><img style="width:200px;height:200px;border-radius:0 !important;" src="<?php echo $sitesql_result['link'];?>"></td>
										 <td><a class="btn btn-danger" href="process_delete_upload_pic.php?id=<?php echo $_id;?>&atmid=<?php echo $_atmid;?>&link=<?php echo $_link;?>" onclick="return atmuploadimagedelete()" >Delete</a></td>
									 </tr>
							 <?php  	 }
						}
                       ?>
                      </tbody>
                    </table>
                  </div>
                </div>
                 <?php }?>
              </div>
            </div>
          </div>
                    </div>
                    <?php include('footer.php');?>
                </div>
            </div>
        </div>
        <script src="vendors/js/vendor.bundle.base.js"></script>
        <script src="vendors/js/vendor.bundle.addons.js"></script>
        
        <script src="js/off-canvas.js"></script>
        <script src="js/hoverable-collapse.js"></script>
        <script src="js/misc.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/todolist.js"></script>
       <!-- <script src="js/dashboard.js"></script>
        <script src="js/viewsite.js"></script> -->
        <script src="js/data-table.js"></script>
        <script src="js/select2.js"></script>
       <script>
function atmuploadimagedelete()
{
	
	//alert(id);alert(atmid);alert(link);
	return confirm('Are you sure to delete this image ?');
	/*
    $.ajax({
			url: "process_delete_upload_pic.php", 
			type: "POST",
			data: {atmid:atmid,id:id,link:link},
			dataType: "html", 
			success: (function (result) { debugger;
			   console.log(result);
			  
			})
		}); */
}   
        </script>       
 
    </body>
</html>
