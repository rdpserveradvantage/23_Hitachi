<?php   
// include "db_connection.php";

// $con = OpenCon(); 
// if($con){ echo "con"; } else {echo 1;}
// die;
?>
<!DOCTYPE html>
<html lang="en">

<?php 
include('head.php');
$con = OpenCon(); 

?>

<style>
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}

form-control {
    border: 1px solid black;
}

hr {
    border-top: 1px solid black;
}
</style>

<body>

    <?php include('top-navbar.php'); 
        include('navbar.php'); ?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <div class="center">
                    <img src="images/audichyalogo.png" style="align: center; width: 150px"
                        alt="Audichaya Bhawan Panch" />
                    <h3 class="page-title">AI Sites</h3>
                </div>
            </div>
            <form action="edit_ai_sites.php" method="post" enctype="multipart/form-data">
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
                                                        $sql = mysqli_query($con,"select * from ai_sites order by id desc");
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
            </form>
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
<?php CloseCon($con); ?>