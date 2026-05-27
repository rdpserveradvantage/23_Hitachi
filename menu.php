<!DOCTYPE html>
<html lang="en">
    <?php 
    include('head.php');
    //include('config.php');
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
                <?php include('navbar-1.php');?>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper" style="padding: 5.5rem 1.7rem !important;">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        
                                        <!--Menu-->
                                        <?php
										$con = OpenCon();
                                        if(isset($_POST['menu_submit'])){
                                            $menu = $_POST['menu'];
                                            
                                            $sql = "insert into main_menu(name,status) values('".$menu."','1')";
                                            
                                            if(mysqli_query($con,$sql)){ ?>
                                                <script>
                                                    alert('Menu Added');
                                                </script>
                                            <?php }else{
                                              ?>
                                                <script>
                                                    alert('Menu Added Error !');
                                                </script>
                                            <?php  
                                            } }
                                        
                                        
                                        ?>
                                        <!--End Menu-->
                                        
                                        
                                        
                                        
                                        <!--Sub Menu-->
                                        
                                        <?php
                                        if(isset($_POST['submenu_submit'])){
                                            $menu = $_POST['menu'];
                                            $submenu = $_POST['submenu'];
                                            $page = $_POST['page'];
                                            $sql = "insert into sub_menu(main_menu,sub_menu,page,status) values('".$menu."','".$submenu."','".$page."','1')";
                                            
                                            if(mysqli_query($con,$sql)){ ?>
                                                <script>
                                                    alert('SubMenu Added');
                                                </script>
                                            <?php }else{
                                                echo mysqli_error($con);
                                              ?>
                                                <script>
                                                    alert('Sub Menu Added Error !');
                                                </script>
                                            <?php  
                                            } }
                                        
                                        
                                        ?>
                                        
                                        
                                        <!--End Sub Menu-->                                        
                                        
                                        
                                        
                                        
                                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                            <div class="row">
                                               <div class="col-sm-12">
                                                   <label>Create Menu</label>
                                                   <input type="text" name="menu" class="form-control">
                                               </div>
                                                 <div class="col-sm-12">
                                                   <br>
                                                   <input type="submit" name="menu_submit" class="btn btn-danger">
                                               </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="card">
                                    <div class="card-body">
                                        

                                        
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Select Under</label>
                                                    <select name="menu" class="form-control" id="main_menu" required>
                                                        <option>Select</option>
                                                        <?php
                                                        $main_sql = mysqli_query($con,"select * from main_menu where status=1");
                                                        while($main_sql_result = mysqli_fetch_assoc($main_sql)){ ?>
                                                            <option value="<?php echo $main_sql_result['id'];?>"><?php echo $main_sql_result['name'];?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <label>Submenu</label>
                                                    <input type="text" name="submenu" class="form-control" required>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Page</label>
                                                    <input type="text" name="page" class="form-control" placeholder="like index.php" required>
                                                </div>
                                                
                                                <div class="col-sm-12">
                                                    <br>
                                                    <input type="submit" name="submenu_submit" class="btn btn-danger">
                                                </div>
                                                
                                                
                                            </div>    
                                    </form>
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