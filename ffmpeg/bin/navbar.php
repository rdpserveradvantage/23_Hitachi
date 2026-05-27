<?php

if(isset($_SESSION['username'])){ 
    $id = $_SESSION['userid'];
    $con = OpenCon(); 
    $user = "select * from loginusers where id=".$id;
    $usersql = mysqli_query($con,$user);
    $usersql_result = mysqli_fetch_assoc($usersql);
    //echo '<pre>';print_r($usersql_result);echo '</pre>';
    $permission = $usersql_result['permission'];
    $permission = explode(',',$permission);
    sort($permission);

$cpermission=json_encode($permission);
$cpermission=str_replace( array('[',']','"') , ''  , $cpermission);
$cpermission=explode(',',$cpermission);
$cpermission = "'" . implode ( "', '", $cpermission )."'";


    $mainmenu = [];
    foreach($permission as $key=>$val){
        
        
        $sub_menu_sql = mysqli_query($con,"select * from sub_menu where id='".$val."' and status=1");
        $sub_menu_sql_result = mysqli_fetch_assoc($sub_menu_sql);
        
         $mainmenu[] = $sub_menu_sql_result['main_menu'];
        
    }
    
$mainmenu    = array_unique($mainmenu);

?>

<nav class="sidebar sidebar-offcanvas bt" id="sidebar">
                    <ul class="nav">
					     <li class="nav-item nav-profile">
                            <div class="nav-link">
                              <div class="profile-image">
                                <img src="../../images/userprofile.jpg" alt="image"/>
                              </div>
                              <div class="profile-name">
                                <p class="name">
                                  Welcome <?php echo $_SESSION['username']; ?>
                                </p>
                                <p class="designation">
                                  <?php 
                                   /* if($_SESSION['designation']==1)
                                     {
                                         echo "Admin";
                                     }
                                     else if($_SESSION['designation']==2) {
                                         echo "Writer Team";
                                     }
                                     else if($_SESSION['designation']==3) {
                                         echo "CTS Team";
                                     }
                                     else {echo " "; }
                                     */
                                  ?>
                                </p>
                              </div>
                            </div>
                        </li>
                        <?php
                        foreach($mainmenu as $menu=>$menu_id){
                        
                        $menu_sql = mysqli_query($con,"select * from main_menu where id='".$menu_id."' and status=1");
                        $menu_sql_result = mysqli_fetch_assoc($menu_sql);
                        $main_name = $menu_sql_result['name']; 
						$menu_icon = $menu_sql_result['menu_icon']; 
                        
                        ?>
						<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#<?php echo $main_name; ?>" aria-expanded="false" aria-controls="<?php echo $main_name; ?>">
							  <i class="fa <?php echo $menu_icon;?> menu-icon fa-3x" style="font-size: 2em;"></i>
							  <span class="menu-title"><?php echo $main_name; ?></span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="<?php echo $main_name; ?>">
							  <ul class="nav flex-column sub-menu">
							    <?php
                                    $submenu_sql = mysqli_query($con,"select * from sub_menu where main_menu = '".$menu_id."' and id in ($cpermission)");
                                    while($submenu_sql_result = mysqli_fetch_assoc($submenu_sql)){ 
                                        $page = $submenu_sql_result['page'];
                                        $submenu_name = $submenu_sql_result['sub_menu'];
										/*if($page=='ticketview1.php' || $page=='ticketview.php'){
											$view = 0;
										}else{
											$view = 1;
										} */
										$view = 1;
										if($view==1){
                                ?>
								
								<?php if($page=="live_view.php") { ?>
								<li class="nav-item"> <a class="nav-link" target="_blank" href="http://103.141.218.26:8080/ComfortTechnoNew/live_view.php"><?php echo $submenu_name; ?></a></li>	
								<?php }else{ ?>	
								  <?php // if($page=='ticketview1.php' || $page=='ticketview.php'){ ?>
								 <!-- <li class="nav-item"> <a class="nav-link" href="#"><?php // echo $submenu_name; ?></a></li> -->
								  <?php// }else{ ?>
								<!-- <li class="nav-item"> <a class="nav-link" href="<?php // echo '../../'.$page; ?>"><?php // echo $submenu_name; ?></a></li> -->
								  <?php //} ?>
								  <li class="nav-item"> <a class="nav-link" href="<?php echo '../../'.$page; ?>"><?php echo $submenu_name; ?></a></li>
									<?php } } }?>
							    
								
							  </ul>
							</div>
						  </li>
						  <?php } ?>
						<!--<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#add" aria-expanded="false" aria-controls="add">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">Add</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="add">
							  <ul class="nav flex-column sub-menu">
							    <li class="nav-item"> <a class="nav-link" href="newsite.php">Site</a></li>
								<li class="nav-item"> <a class="nav-link" href="add_ticket.php">Ticket</a></li>
								
								<li class="nav-item"> <a class="nav-link" href="js-grid.html">Js-grid</a></li>
								<li class="nav-item"> <a class="nav-link" href="sortable-table.html">Sortable table</a></li>
							  </ul>
							</div>
						  </li>
						<li class="nav-item">
                            <a class="nav-link" href="EMS/" target="_blank">
                                <i class="fa fa-microchip menu-icon">
                                </i>
                                <span class="menu-title">
                                    EMS
                                </span>
                            </a>
                        </li>
						 <li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">View</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="tables">
							  <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="viewsitenew.php">Site</a></li>
								<li class="nav-item"> <a class="nav-link" href="panel_health.php">Panel Health</a></li>
								<li class="nav-item"> <a class="nav-link" href="view_ticket.php">Ticket</a></li>
								<li class="nav-item"> <a class="nav-link" href="view_alert_ticket.php">Alert Ticket</a></li>
							  </ul>
							</div>
						  </li>
                          <li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#views" aria-expanded="false" aria-controls="views">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">Views</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="views">
							  <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="sitehealth.php">Site Health</a></li>
								<li class="nav-item"> <a class="nav-link" href="ticketview.php">Ticket View</a></li>
								<li class="nav-item"> <a class="nav-link" href="aiticketview.php">AI Ticket View</a></li>
								<li class="nav-item"> <a class="nav-link" href="live_view.php">Live View</a></li>
								<li class="nav-item"> <a class="nav-link" href="locations.php">Location</a></li>
                                <li class="nav-item"> <a class="nav-link" href="ticketviewservice.php">Ticket View Service</a></li>
								<li class="nav-item"> <a class="nav-link" href="queryticketdata.php">Query Ticket Data</a></li>
								<li class="nav-item"> <a class="nav-link" href="supervisor.php">Supervisor Screen</a></li>
								<li class="nav-item"> <a class="nav-link" href="servicecall.php">Service Call</a></li>
                                <li class="nav-item"> <a class="nav-link" href="installationcall.php">Installation Call</a></li>
								<li class="nav-item"> <a class="nav-link" href="materialrequire.php">Material Required</a></li>
							  </ul>
							</div>
						  </li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#configuration" aria-expanded="false" aria-controls="configuration">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">Configuration</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="configuration">
							  <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="sitelist.php">Site</a></li>
								<li class="nav-item"> <a class="nav-link" href="userlist.php">User</a></li>
								<li class="nav-item"> <a class="nav-link" href="rolelist.php">Role</a></li>
								<li class="nav-item"> <a class="nav-link" href="movelist.php">Move Site</a></li>
                                <li class="nav-item"> <a class="nav-link" href="resetpassword.php">Reset Password</a></li>
								
								<li class="nav-item"> <a class="nav-link" href="escalationlist.php">Escalation Matrix</a></li>
                                <li class="nav-item"> <a class="nav-link" href="adcommentlist.php">AD Comment</a></li>
								<li class="nav-item"> <a class="nav-link" href="zoneconfiguration.php">Zone Configuration</a></li>
                                <li class="nav-item"> <a class="nav-link" href="panellistconfiguration.php">Panel Configuration</a></li>
								<li class="nav-item"> <a class="nav-link" href="aduser.php">AD User</a></li>
							  </ul>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#reports" aria-expanded="false" aria-controls="reports">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">Reports</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="reports">
							  <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="dvrhealthreport.php">DVR Health Report</a></li>
								<li class="nav-item"> <a class="nav-link" href="ticketreport.php">Ticket View Report</a></li>
								<li class="nav-item"> <a class="nav-link" href="cmereport.php">CME Report</a></li>
								<li class="nav-item"> <a class="nav-link" href="panelstatusreport.php">Panel Status Report</a></li>
                                <li class="nav-item"> <a class="nav-link" href="sitenetworkstatus.php">Site Network Status</a></li>
								<li class="nav-item"> <a class="nav-link" href="dvrreport.php">DVR Report</a></li>
                                <li class="nav-item"> <a class="nav-link" href="zonestatusreport.php">Zone Status Report</a></li>
								<li class="nav-item"> <a class="nav-link" href="excelreport.php">Excel Reports</a></li>
                                <li class="nav-item"> <a class="nav-link" href="sitedownreport.php">Site Down Report</a></li>
							  </ul>
							</div>
						</li>
                        <li class="nav-item">
							<a class="nav-link" data-toggle="collapse" href="#changepassword" aria-expanded="false" aria-controls="changepassword">
							  <i class="fas fa-table menu-icon"></i>
							  <span class="menu-title">Utility</span>
							  <i class="menu-arrow"></i>
							</a>
							<div class="collapse" id="changepassword">
							  <ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link" href="ChangePassword.php">Change Password</a></li>
								
							  </ul>
							</div>
						</li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="fa fa-home menu-icon">
                                </i>
                                <span class="menu-title">
                                    E-surveillance
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/widgets.html">
                                <img alt="Watching" class="menu-icon" src="fonts/menu-icon/watch.png">
                                    <span class="menu-title">
                                        Watching
                                    </span>
                                </img>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="pages/widgets.html">
                                <img alt="Archive" class="menu-icon" src="fonts/menu-icon/archive.png">
                                    <span class="menu-title">
                                        Archive
                                    </span>
                                </img>
                            </a>
                        </li>  
                        <li class="nav-item">
                            <a class="nav-link" href="ffmpeg/bin/pagination.php">
							    <i class="fa fa-file-video menu-icon">
                                </i>
                                <span class="menu-title">
                                    Video Archive
                                </span>
                               
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="snaps.php">
							
							<i class="fas fa-images menu-icon">
                                </i>
                                <span class="menu-title">
                                    Snaps
                                </span>
                              
                            </a>
                        </li> -->
						<li class="nav-item icons-list">
                            <a class="nav-link" href="../../logout.php">
                                <i class="fa fa-sign-out-alt menu-icon fa-3x" style="font-size: 2em;">
                                </i>
                                <span class="menu-title">
                                    Logout
                                </span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav bt">
                        <!-- <li class="nav-item nav-settings d-none d-lg-block" style="margin: 0 auto;margin-top: 3%;">
                            <button class="btn btn-primary btn-rounded btn-icon" type="button">
                                <i class="fa fa-bell">
                                </i>
                            </button>
                        </li> -->
                        <li class="nav-item nav-settings d-none d-lg-block" style="margin: 0 auto;margin-top: 3%;">
                            <button class="btn btn-primary btn-rounded btn-icon" type="button">
                                <i class="fa fa-bell">
                                </i>
                            </button>
                            <!-- <span class="count text-white">16</span> -->
                        </li>
                    </ul>
                    <ul class="nav bt">
                        <li class="nav-item nav-settings d-none d-lg-block" style="margin: 0 auto;margin-top: 3%;">
                            <h5 class="text-white">
                                Wednesday 5:40 pm
                            </h5>
                            <h5 class="text-white">
                                25 August, 2021
                            </h5>
                        </li>
                    </ul>
                </nav>
	<?php CloseCon($con); } ?>			