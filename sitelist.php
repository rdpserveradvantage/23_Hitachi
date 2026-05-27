<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    include('config.php');
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
			height: 210px; */
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
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_settings-panel.html -->
                <!-- partial -->
                <!-- partial:partials/_sidebar.html -->
                <?php include('navbar.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    <?php include('filters/sitelist_filter.php')?>              
          <div class="card">
            <div class="card-body">
            <!-- <h4 class="card-title" style="color:#fff;">Site List</h4> -->
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     <br>
                        <tr>
                            <th>Action</th>
							<th>ATMID</th>
                            <th>ATMID 2</th>
                            <th>ATMID 3</th>
                            <th>ATMID 4</th>
                            <th>Tracker No.</th>
                            <th>ATM ShortName</th>
                            <th>Phase</th>
                            <th>Status</th>
                            <th>Old Panel ID</th>
                            <th>New Panel ID</th>
                            <th>DVR IP</th>
                            <th>DVR Name</th>
                            <th>Panel IP</th>
                            <th>DVR Model Number</th>
                            <th>Router Model Number</th>
                            <th>Engineer Name</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Site Address</th>
                            <th>State</th>
                            <th>City</th>
							<th>Zone</th>
                            <th>Panel Make</th>
                            <th>Live</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Remark</th>           
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sql= mysqli_query($con,"SELECT * from sites");
                       
                      $i=1;
                      while($sql_result=mysqli_fetch_assoc($sql)) {
                      ?>
                        <tr>
                        <td> <a href="updatesite.php?id=<?=$sql_result['SN']?>" class="btn btn-primary" id="Button">Edit</a> </td>
								<td><?php echo $sql_result['ATMID'] ?></td>
                                <td><?php echo $sql_result['ATMID_2'] ?></td>
								<td><?php echo $sql_result['ATMID_3'] ?></td>
								<td><?php echo $sql_result['ATMID_4'] ?></td>
								<td><?php echo $sql_result['TrackerNo'] ?></td>
                                <td><?php echo $sql_result['ATMShortName'] ?></td>
                                <td><?php echo $sql_result['Phase'] ?></td>
								<td><?php echo $sql_result['Status'] ?></td>
								<td><?php echo $sql_result['OldPanelID'] ?></td>
                                <td><?php echo $sql_result['NewPanelID'] ?></td>
                                <td><?php echo $sql_result['DVRIP'] ?></td>
                                <td><?php echo $sql_result['DVRName'] ?></td>
                                <td><?php echo $sql_result['PanelIP'] ?></td>
                                <td><?php echo $sql_result['DVR_Model_num'] ?></td>
                                <td><?php echo $sql_result['Router_Model_num'] ?></td>
                                <td><?php echo $sql_result['eng_name'] ?></td>
                                <td><?php echo $sql_result['Customer'] ?></td>
                                <td><?php echo $sql_result['Bank'] ?></td>
                                <td><?php echo $sql_result['SiteAddress'] ?></td>
                                <td><?php echo $sql_result['State'] ?></td>
                                <td><?php echo $sql_result['City'] ?></td>
                                <td><?php echo $sql_result['Zone'] ?></td>
								<td><?php echo $sql_result['Panel_Make'] ?></td>
                                <td><?php echo $sql_result['live'] ?></td>
                                <td><?php echo $sql_result['UserName'] ?></td>
                                <td><?php echo $sql_result['Password'] ?></td>
                                <td><?php echo $sql_result['site_remark'] ?></td>
                            
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
          <script src="js/data-table.js">
        </script>
        <script src="vendors/video-js/video.min.js">
        </script>

    </body>
</html>
