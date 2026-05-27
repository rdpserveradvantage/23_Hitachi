<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
  //  include('config.php');
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
                                        
                                        <?php
                                         $con = OpenCon();
                                        $userid = $_GET['id']; 
                                        $usersql = mysqli_query($con,"select * from loginusers where id='".$userid."'");
                                        $usersql_result = mysqli_fetch_assoc($usersql);
                                        $user_permission = $usersql_result['permission'];
                                        $user_permission = explode (",", $user_permission);
										
										$user_customer = $usersql_result['cust_id'];
                                        $user_customer = explode (",", $user_customer);
										
										$user_bank = $usersql_result['bank_id'];
                                        $user_bank = explode (",", $user_bank);
										
										$user_zonal = $usersql_result['zonal'];
                                        $user_zonal = explode (",", $user_zonal);
										
										$user_circle = $usersql_result['circle_id'];
                                        $user_circle = explode (",", $user_circle);
                                        
                                        if(isset($_POST['submit'])){
                                            
                                        

                                        
                                        $permission =$_POST['sub_menu'];
                                        $permission = implode(',',$permission);
                                       
									    $customer =$_POST['cust_id'];
                                        $customer = implode(',',$customer);
										
										$bank = "";
										if(isset($_POST['bank_id'])){
										$bank =$_POST['bank_id'];
                                        $bank = implode(',',$bank);
										}
										
										$zonal =$_POST['zonal'];
                                        $zonal = implode(',',$zonal);
										
										$circle = "";
										if(isset($_POST['circle_id'])){
										$circle =$_POST['circle_id'];
                                        $circle = implode(',',$circle);
										}
										
                                         $sql = "update loginusers set permission='".$permission."',cust_id='".$customer."',bank_id='".$bank."',zonal='".$zonal."',circle_id='".$circle."' where id='".$userid."'"; 
                                         
                                         if(mysqli_query($con,$sql)){ ?>
                                             <script>
                                                 alert('Updated !');
                                                 window.location.href="allotmenu_perm.php?id="+<?php echo $userid;?>;
                                             </script>
                                        <?php      }else{ ?>
                                           <script>
                                                 alert('Error ! ');
                                                 window.location.href="allotmenu_perm.php?id="+<?php echo $userid;?>;
                                             </script> 
                                        <?php }
                                            }
                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $userid?>" method="POST">
                                            <ul>
                                            <?php
                                            
                                            $mainsql = mysqli_query($con,"select * from main_menu where status=1");
                                            while($mainsql_result = mysqli_fetch_assoc($mainsql)){
                                            $main_id = $mainsql_result['id'];
                                            ?>
                                                
                                              
                                                  <li>
                                                     <input type="checkbox" class="main_menu" value="<?php echo $main_id;?>"> <?php echo $mainsql_result['name'];?>   
                                                  
                                              
                                                <!--<br>-->
                                                
                                                <ul class="showsubmenu">
                                                        
                                                        <?php $sub_sql = mysqli_query($con,"select * from sub_menu where main_menu='".$main_id."'");
                                                        while($sub_sql_result = mysqli_fetch_assoc($sub_sql)){
                                                        $sub_id = $sub_sql_result['id'];
                                                        ?>
                                                            
                                                    <li>
                                                            <input class="submenu" type="checkbox" data-main_id="<?php echo $main_id?>" name="sub_menu[]" value="<?php echo $sub_id; ?>" <?php if(in_array($sub_id,$user_permission)){ echo 'checked' ; } ?> > <?php echo $sub_sql_result['sub_menu'];?>
                                                    </li>
                                                            
                                                            <!--<br>-->
                                                        <?php } ?>
                                                </ul>
                                                </li>
                                            <?php } ?>
                                            </ul>
											<hr>
											<h6>Select Customer For Permissions</h6>
											<ul class="showsubmenu">
											    <?php $sql = mysqli_query($con,"select Customer from sites where live='Y' group by Customer");
                                                        while($sql_result = mysqli_fetch_assoc($sql)){
                                                        $cust_id = $sql_result['Customer'];
														if($cust_id!=''){
                                                        ?>
                                                            
                                                    <li>
                                                            <input class="submenu" type="checkbox"  name="cust_id[]" value="<?php echo $cust_id; ?>" <?php if(in_array($cust_id,$user_customer)){ echo 'checked' ; } ?> > <?php echo $sql_result['Customer'];?>
                                                    </li>
                                                            
                                                            <!--<br>-->
                                                        <?php } }?>
											</ul>
											<hr>
											<h6>Select Bank Based On Customer For Permissions</h6>
											<div class="row">
											<?php for($i=0;$i<count($user_customer);$i++){ ?>
												<div class="col-md-12 grid-margin stretch-card">
												  <div class="card">
													<div class="card-body">
													  <h4 class="card-title"><?php echo $user_customer[$i];?></h4>
													  
													  <div class="form-group">
														<label>Select Bank For Permissions</label>
														<select class="js-example-basic-multiple w-100" multiple="multiple" name="bank_id[]">
														  <?php $_client = $user_customer[$i];;
													        $banksql = mysqli_query($con,"select Bank from sites where Customer='".$_client."' AND live='Y' group by Bank");
                                                            while($bank_sql_result = mysqli_fetch_assoc($banksql)){
																$_bank = $bank_sql_result['Bank'];
																$cust_bank = $user_customer[$i].'_'.$_bank;
													  ?>
														  <option value="<?php echo $cust_bank;?>" <?php if(in_array($cust_bank,$user_bank)){ echo 'selected' ; } ?>><?php echo $_bank;?></option>
															<?php }
															        $_dvrbank = 'Axis-WLA';
																    $cust_dvrbank = $user_customer[$i].'_'.$_dvrbank;
															/*$dvrbanksql = mysqli_query($con,"select Bank from dvronline where customer='".$_client."' AND Status='Y' group by Bank");
															if(mysqli_num_rows($dvrbanksql)>0){
																 while($dvrbank_sql_result = mysqli_fetch_assoc($dvrbanksql)){
																	$_dvrbank = $dvrbank_sql_result['Bank'];
																    $cust_dvrbank = $user_customer[$i].'_'.$_dvrbank; */
															?>
														 <option value="<?php echo $cust_dvrbank;?>" <?php if(in_array($cust_dvrbank,$user_bank)){ echo 'selected' ; } ?>><?php echo $_dvrbank;?></option>	
															<?php	// }
															//}
															?>
														</select>
													  </div>
													</div>
												  </div>
												</div>
											<?php } ?>	
                                            </div>
											<hr>
											<h6>Select Zonal For Permissions</h6>
											<ul class="showsubmenu">
											    <?php $sql = mysqli_query($con,"select Zonal from site_circle group by Zonal");
                                                        while($sql_result = mysqli_fetch_assoc($sql)){
                                                        $zonal_id = $sql_result['Zonal'];
														if($zonal_id!=''){
                                                        ?>
                                                            
                                                    <li>
                                                            <input class="submenu" type="checkbox"  name="zonal[]" value="<?php echo $zonal_id; ?>" <?php if(in_array($zonal_id,$user_zonal)){ echo 'checked' ; } ?> > <?php echo $sql_result['Zonal'];?>
                                                    </li>
                                                            
                                                            <!--<br>-->
                                                        <?php } } ?>
											</ul>
											<hr>
											<h6>Select Circle Based On Zonal For Permissions</h6>
											<div class="row">
											<?php for($i=0;$i<count($user_zonal);$i++){ ?>
												<div class="col-md-12 grid-margin stretch-card">
												  <div class="card">
													<div class="card-body">
													  <h4 class="card-title"><?php echo $user_zonal[$i];?></h4>
													  
													  <div class="form-group">
														<label>Select Circle For Permissions</label>
														<select class="js-example-basic-multiple w-100" multiple="multiple" name="circle_id[]">
														  <?php $_zonal = $user_zonal[$i];;
													        $banksql = mysqli_query($con,"select Circle from site_circle where Zonal='".$_zonal."' group by Circle");
                                                            while($bank_sql_result = mysqli_fetch_assoc($banksql)){
																$_circle = $bank_sql_result['Circle'];
																$cust_circle = $user_zonal[$i].'_'.$_circle;
													  ?>
														  <option value="<?php echo $cust_circle;?>" <?php if(in_array($cust_circle,$user_circle)){ echo 'selected' ; } ?>><?php echo $_circle;?></option>
															<?php } ?>
														</select>
													  </div>
													</div>
												  </div>
												</div>
											<?php } ?>	
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <br>
                                                    <input type="submit" name="submit" class="btn btn-danger">                                                    
                                                </div>

                                                
                                            </div>
                                        </form>
                                        
                                        
                                        <div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
              
                    
    <?php CloseCon($con); include('footer.php'); ?>
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
		<script src="js/typeahead.js"></script>
        <script src="js/select2.js"></script>

</body>

</html>