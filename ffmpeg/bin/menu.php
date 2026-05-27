 
    <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!-- <a href="../../index.html" class="logo">
                            <span class="logo-small"><i class="mdi mdi-radar"></i></span>
                            <span class="logo-large"><i class="mdi mdi-radar"></i> Highdmin</span>
                        </a> -->
                        <!-- Image Logo -->
                        <a href="../../../../dashboard.php" class="logo">
                            <img src="../../assets/images/logo_sm.png" alt="" height="26" class="logo-small">
                            <img src="../../assets/images/logo.png" alt="" height="50" class="logo-large">
                        </a>


                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras topbar-custom">

                        <ul class="list-unstyled topbar-right-menu float-right mb-0">

                            <li class="menu-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>
                          

                        
                            

                           <li class="dropdown notification-list">
                                <a class="nav-link dropdown-toggle waves-effect nav-user" data-toggle="dropdown" href="../../#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                     <input type="button" class="rounded-circle" style="height:40px;width:40px;padding-bottom: 57px" value="<?php echo strtoupper(substr($_SESSION['name'], 0, 1));?>"> <span class="ml-1 pro-user-name"><?php echo strtoupper($_SESSION['name']);?><i class="mdi mdi-chevron-down"></i> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated profile-dropdown">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h6 class="text-overflow m-0">Welcome <?php echo $_SESSION['name'];?>!</h6>
                                    </div>


                                    <a href="../../logout.php" class="dropdown-item notify-item">
                                        <i class="fi-power"></i> <span>Logout</span>
                                    </a>

                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- end menu-extras -->

                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                         <li class="has-submenu">
                                <a href="../../dashboard.php"><i class="icon-speedometer"></i>Dashboard </a>
                            </li>
                           <li class="has-submenu">
                                <a href="pagination.php"><i class="icon-layers"></i>Videos</a>
                            </li>
                            
                           </li>
                          <!--  <li class="has-submenu">
                                <a href="../../snaps.php"><i class="icon-layers"></i>Snaps</a>
                            </li> -->
                           


                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->
