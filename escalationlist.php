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
                        <h3 class="card-title">Escalation </h3>

                    <?php include("filters/escalation_filter.php");?>
                    <br>
                    <div class="card">
                    <div class="card-body">
                    <!-- <h4 class="card-title" >DVR Health Status-Online</h4> -->


                    <div class="row">
                    <div class="col-12" id="escalation_tbody">
                    <div class="table-responsive">
                    <table id="order-listing" class="table">
                    <thead>

                        <tr>
                            
                           <!-- <th>Action</th> -->
                            <th>ID</th>
                            <th>Type</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Mobile</th>
                            <th>Landline</th>
                            <th>Email</th>
                            <th>Escalation Email</th>
                            <th>Priority</th> 
                            <th>Duration</th>                            
                            <th>RrepeatInterval</th>                             

                        </tr>
                    </thead>
                    <tbody >
                        
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
                    <script src="js/escalation.js"></script>
                    <script>
                        onload();
                    </script>

                    
                    </body>
                    </html>
