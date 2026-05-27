<?php   
// include "db_connection.php";

// $con = OpenCon(); 
// // if($con){ echo "con"; } else {echo 1;}
// // die;

// $id = $_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); 
$con = OpenCon(); 
// if($con){ echo "con"; } else {echo 1;}
// die;

$id = $_GET['id'];
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
                    <img src="images/audichyalogo.png" style="align:center; width:150px" alt="Audichaya Bhawan Panch">
                    <h3 class="page-title">
                        AI Sites
                    </h3>
                </div>
            </div>
            <form action="update_ai_sites.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <?php
                            
                            
                            $sql = mysqli_query($con,"select * from ai_sites where id='".$id."'");
                             while($sql_result = mysqli_fetch_row($sql)){
                            
                            
                            ?>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">Project</label>
                                        <div class="col-sm-12">

                                            <input type="hidden" name="site_id" id="site_id" value="<?=$id;?>" />

                                            <input type="text" class="form-control" name="project" id="project"
                                                value="<?=$sql_result[1]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Customer </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="customer" id="customer"
                                                value="<?=$sql_result[2]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Bank</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="bank" id="bank"
                                                value="<?=$sql_result[3]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">Atmid</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="atmid" id="atmid"
                                                value="<?=$sql_result[4]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Location</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="location" id="location"
                                                value="<?=$sql_result[5]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Site Address </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="site_add" id="site_add"
                                                value="<?=$sql_result[6]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">City</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="city" id="city"
                                                value="<?=$sql_result[7]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">State </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="state" id="state"
                                                value="<?=$sql_result[8]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Zone </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="zone" id="zone"
                                                value="<?=$sql_result[9]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">New PanelID </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="new_panelid" id="new_panelid"
                                                value="<?=$sql_result[10]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">DVR IP</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="dvrip" id="dvrip"
                                                value="<?=$sql_result[11]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">DVR Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="dvrname" id="dvrname"
                                                value="<?=$sql_result[12]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">Username</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="usrname" id="usrname"
                                                value="<?=$sql_result[13]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Password </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pwd" id="pwd"
                                                value="<?=$sql_result[14]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Live </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="live" id="live"
                                                value="<?=$sql_result[15]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label"> RTSP Stream </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="rtsp" id="rtsp"
                                                value="<?=$sql_result[16]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Pie Username</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pieusrname" id="pieusrname"
                                                value="<?=$sql_result[17]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Pie Password </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="piepwd" id="piepwd"
                                                value="<?=$sql_result[18]; ?>" />
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">Panel IP </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="panelip" id="panelip"
                                                value="<?=$sql_result[19]; ?>" />
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Alert Type </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="alerttype" id="alerttype"
                                                value="<?=$sql_result[20]; ?>" />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">SN </label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="serialno" id="serialno"
                                                value="<?=$sql_result[21]; ?>" />
                                        </div>
                                    </div>

                                </div>
                                <?php } ?>
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submit" class="btn btn-primary mr-2">Update</button>
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
</body>

</html>
<?php CloseCon($con);?>