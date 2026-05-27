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
                    <?php include("filters/movelist_filters.php");?>
                    <br>
                    <div class="card">
                    <div class="card-body">
                    <!-- <h4 class="card-title" style="color:#fff;">DVR Health Status-Online</h4> -->


                    <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                    <table id="order-listing" class="table">
                    <thead>

                        <tr>
                            
                            <th>Action</th>
                            <th>SrNo.</th>
                            <th>Site Name</th>
                            <th>Branch Code</th>
                            <th>Address</th>
                            <th>State</th>
                            <th>DVR IP/Panel</th>
                            <th>Zone</th>
                            <th>DVR Port</th> 
                            <th>DVR Model</th>                            
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td><a href="" class="btn btn-primary" id="Button">Move</a></td> 
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                        </tr>
                        
                        
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
