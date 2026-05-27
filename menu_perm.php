<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
   // include('config.php');
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
		.videoplay_msg{
			display:none;
		}
	</style>
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
                                <div class="card">
                                    <div class="card-body">
                                        
                                        
                                        <table class="table table-bordered table-striped table-hover dataTable js-exportable no-footer" id="data_table">
                                          <thead>
                                            <tr>
                                                <th>SR</th>
                                                <th>Name</th>
                                                <th>username</th>
                                                <th>Edit</th>
                                            </tr>
                                          </thead>
                                            
                                        <tbody>
                                            <?php $i = 1; 
											$con = OpenCon();
                                            $sql = mysqli_query($con,"select * from loginusers");
                                            while($sql_result = mysqli_fetch_assoc($sql)){
                                            $id = $sql_result['id'];
                                            ?>
                                               <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $sql_result['name'];?></td>
                                                    <td><?php echo $sql_result['uname']; ?></td>
                                                    <td><a href="allotmenu_perm.php?id=<?php echo $id ; ?>" class="btn btn-danger" style="color:white;">Edit</a></td>
                                                </tr>
                                            <?php $i++; } ?>

                                        </tbody>
                                        
                                        </table>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
               
                    
    <?php CloseCon($con); include('footer.php');?>     
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


</body>

</html>