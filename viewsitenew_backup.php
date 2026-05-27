<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    include('config.php');
    ?>
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
    <body class="sidebar-dark">
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row default-layout-navbar navbar-dark">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img alt="logo" src="media/logo.png"/>
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" data-toggle="minimize" type="button">
                        <span class="fas fa-bars">
                        </span>
                    </button>
                    <ul class="navbar-nav navbar-nav-left">
                        <li class="nav-item nav-search d-none d-md-flex">
                            <div class="nav-link">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-search">
                                            </i>
                                        </span>
                                    </div>
                                    <input aria-label="Search" class="form-control" placeholder="Search" type="text">
                                    </input>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#">
                                <i class="fas fa-ellipsis-v">
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
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
              <h4 class="card-title" style="color:#fff;">View Site</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
                            <th>SN</th>
                            <th>DVR IP</th>
                            <th>ATM ID</th>
                            <th>Customer</th>
                            <th>Bank</th>
                            <th>Site Address</th>
                            <th>State</th>
                            <th>City</th>
							<th>Zone</th>
                            <th>Panel Make</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sql= mysqli_query($con,"SELECT * from sites");
                       
                      $i=1;
                      while($sql_result=mysqli_fetch_assoc($sql)) {
                      ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $sql_result['DVRIP'] ?></td>
                                <td><?php echo $sql_result['ATMID'] ?></td>
                                <td><?php echo $sql_result['Customer'] ?></td>
                                <td><?php echo $sql_result['Bank'] ?></td>
                                <td><?php echo $sql_result['SiteAddress'] ?></td>
                                <td><?php echo $sql_result['State'] ?></td>
                                <td><?php echo $sql_result['City'] ?></td>
                                <td><?php echo $sql_result['Zone'] ?></td>
								<td><?php echo $sql_result['Panel_Make'] ?></td>
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
				   $("#atmid").html(data);
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
	  // alert(panelid);
	  if(panelid=="all"){
		  window.location = "index.php";
	  }
	   search_panel(panelid);
   })

</script>

<?php 

function status($status)
{
    $sql=mysqli_query($con,"select * from sites where status='".$status."'");
    $sql_result = mysqli_fetch_assoc($sql);

    return sql_result['sites'];

}

?>
    </body>
</html>
