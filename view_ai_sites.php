<!DOCTYPE html>
<html lang="en">
    <?php include('head.php');
	$conn = OpenCon();
	    //if($con) { echo "11111";} 
	?>
	
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
                         <h6 class="card-title">AI Sites</h6> 
                          <?php //include('filters/sitehealth_filter.php');?>
						</div> 
						
            
                <div class="row">
                    <div class="col-md-12 stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data table</h4>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table id="order-listing" class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order #</th>
                                                        <th>Project</th>
                                                        <th>Customer</th>
                                                        <th>Bank</th>
                                                        <th>ATMID</th>
                                                        <th>Location</th>
                                                        <th>Site Address</th>
                                                        <th>City</th>
                                                        <th>State</th>
                                                        <th>Zone</th>
                                                        <th>New PanelID</th>
                                                        <th>DVR IP</th>
                                                        <th>DVR Name</th>
                                                        <th>Username</th>
                                                        <th>Password</th>
                                                        <th>Live</th>
                                                        <th>RTSP Stream</th>
                                                        <th>Pie Username</th>
                                                        <th>Pie Password</th>
                                                        <th>Panel IP</th>
                                                        <th>Alert type</th>
                                                        <th>SN</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 1;
														$ai_sites = "select * from ai_sites order by id desc";
														//echo $ai_sites;
                                                        $sql = mysqli_query($conn,$ai_sites);
														//echo $num_rows = mysqli_num_rows($sql);
                                                        while($sql_result = mysqli_fetch_row($sql)){
                                                        
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $i;?>
                                                        </td>
                                                        <td><?=$sql_result[1]; ?></td>
                                                        <td><?=$sql_result[2]; ?></td>
                                                        <td><?=$sql_result[3]; ?></td>
                                                        <td><?=$sql_result[4]; ?></td>
                                                        <td><?=$sql_result[5]; ?></td>
                                                        <td><?=$sql_result[6]; ?></td>
                                                        <td><?=$sql_result[7]; ?></td>
                                                        <td><?=$sql_result[8]; ?></td>
                                                        <td><?=$sql_result[9]; ?></td>
                                                        <td><?=$sql_result[10]; ?></td>
                                                        <td><?=$sql_result[11]; ?></td>
                                                        <td><?=$sql_result[12]; ?></td>
                                                        <td><?=$sql_result[13]; ?></td>
                                                        <td><?=$sql_result[14]; ?></td>
                                                        <td><?=$sql_result[15]; ?></td>
                                                        <td><?=$sql_result[16]; ?></td>
                                                        <td><?=$sql_result[17]; ?></td>
                                                        <td><?=$sql_result[18]; ?></td>
                                                        <td><?=$sql_result[19]; ?></td>
                                                        <td><?=$sql_result[20]; ?></td>
                                                        <td><?=$sql_result[21]; ?></td>
                                                        <td>
                                                            <a href="edit_ai_sites.php?id=<?=$sql_result[0] ?>"><button
                                                                    class="btn btn-outline-primary">
                                                                    Edit
                                                                </button></a>
                                                        </td>
                                                    </tr>

                                                    <?php $i++; }  
                                                    
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>

    <script src="vendors/js/vendor.bundle.base.js"></script>
    <script src="vendors/js/vendor.bundle.addons.js"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/misc.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/file-upload.js"></script>
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/data-table.js"></script>
</body>

</html>
<?php CloseCon($conn); ?>
