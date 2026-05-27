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
	//  echo mysqli_num_rows($sql);die;
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
   
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
				<input type="hidden" id="hidden_atm_id" value="<?php echo $atmid;?>">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                     
                        <tr>
						    
                            <!--<th>Action</th>-->
							
							<th>ATMID</th>
							<th>Uploaded Image</th>
                            <th>Check All <input type="checkbox" class='checkall' id='checkall'><input class="btn btn-danger" type="button" id='delete_record' value='Delete' ></th>
							
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
										 <td><input type='checkbox' class='delete_check' id='delcheck_<?php echo $_id; ?>' onclick='checkcheckbox();' value='<?php echo $_id; ?>'></td>
										<!-- <td><a class="btn btn-danger" href="process_delete_upload_pic.php?id=<?php echo $_id;?>&atmid=<?php echo $_atmid;?>&link=<?php echo $_link;?>" onclick="return atmuploadimagedelete()" >Delete</a></td>-->
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
			url: "delete_atm_upload_pic.php", 
			type: "POST",
			data: {deleteids_arr: deleteids_arr},
			success: (function (result) { debugger;
			   console.log(result);
			   if(result==1){
				   swal("Great!", "Image Deleted Successfully !", "success");

				   setTimeout(function(){ 
					   window.location.href="viewsitenew.php";
				   }, 3000);
			   }
			})
		}); */
}   
        </script>      

        <script>
                $(document).ready(function(){

                  // Check all 
				   $('#checkall').click(function(){
					  if($(this).is(':checked')){
						 $('.delete_check').prop('checked', true);
					  }else{
						 $('.delete_check').prop('checked', false);
					  }
				   });

				   // Delete record
				   $('#delete_record').click(function(){

					  var deleteids_arr = [];
					  // Read all checked checkboxes
					  $("input:checkbox[class=delete_check]:checked").each(function () {
						 deleteids_arr.push($(this).val());
					  });

					  // Check checkbox checked or not
					  if(deleteids_arr.length > 0){
                         var atm_id = $('#hidden_atm_id').val();
						   confirm(deleteids_arr);
						 // Confirm alert
						/* var confirmdelete = confirm("Do you really want to Delete records?");
						 if (confirmdelete == true) {
							$.ajax({
							   url: 'delete_atm_upload_pic.php',
							   type: 'post',
							   data: {deleteids_arr: deleteids_arr},
							   success: function(response){
								  // var currentURL = window.location.href + '?atmid=' + atm_id;
                                   var currentURL = window.location.href;
								  if(response==1){
									   swal("Great!", "Image Deleted Successfully !", "success");

									   setTimeout(function(){ 
										   window.location.href = currentURL;
									   }, 3000);
								   }
							   }
							});
						 } */
					  }
				   });

				});
				
				

				// Checkbox checked
				function checkcheckbox(){

				   // Total checkboxes
				   var length = $('.delete_check').length;

				   // Total checked checkboxes
				   var totalchecked = 0;
				   $('.delete_check').each(function(){
					  if($(this).is(':checked')){
						 totalchecked+=1;
					  }
				   });

				   // Checked unchecked checkbox
				   if(totalchecked == length){
					  $("#checkall").prop('checked', true);
				   }else{
					  $('#checkall').prop('checked', false);
				   }
				}
				
				function confirm(deleteids_arr) {
					swal({
						title: "Are you sure?",
						text: "Once deleted, you will not be able to recover this image file!",
						icon: "warning",
						buttons: true,
						dangerMode: true,
					})
					.then((willDelete) => {
						if (willDelete) {
							
								$.ajax({
								   url: 'delete_atm_upload_pic.php',
								   type: 'post',
								   data: {deleteids_arr: deleteids_arr},
								   success: function(response){
									   alert(response);
									  // var currentURL = window.location.href + '?atmid=' + atm_id;
									   var currentURL = window.location.href;
									  if(response==1){
										   swal("Great!", "Image Deleted Successfully !", "success");

										   setTimeout(function(){ 
											   window.location.href = currentURL;
										   }, 3000);
									   }
								   }
								});
							
						} else {
							swal("Your image file is safe!");
						}
					});
			 
					return false;
				}
        </script>		
 
    </body>
</html>
