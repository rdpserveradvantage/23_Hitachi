<?php

include "db_connection.php";

date_default_timezone_set('Asia/Kolkata');

$con = OpenCon();

// var_dump($_POST); die;
$project = $_POST['project'];
$customer = $_POST['customer'];
$bank = $_POST['bank'];
$atmid = $_POST['atmid'];
$location = $_POST['location'];
$site_add = $_POST['site_add'];
$city = $_POST['city'];
$state = $_POST['state'];
$zone = $_POST['zone'];
$newpanelid = $_POST['new_panelid'];
$dvrip = $_POST['dvrip'];
$dvrname = $_POST['dvrname'];
$username = $_POST['usrname'];
$password = $_POST['pwd'];
$live = $_POST['live'];
$rtsp = $_POST['rtsp'];
$pieusr = $_POST['pieusrname'];
$piepwd = $_POST['piepwd'];
$panelip = $_POST['panelip'];
$alerttype = $_POST['alerttype'];
$sn = $_POST['serialno'];

$created_at = date('Y-m-d H:i:s');
// $updated_at = date('Y-m-d H:i:s');

$sql = "insert into ai_sites(`Project`, `Customer`, `Bank`, `ATMID`, `Location`, `SiteAddress`, `City`, `State`, `Zone`, `NewPanelID`, `DVRIP`, `DVRName`, `UserName`, `Password`, `live`, `rtsp_stream`, `pie_username`, `pie_pwd`, `PanelIP`, `AlertType`, `SN`,`created_at`) values ('".$project."','".$customer."','".$bank."','".$atmid."','".$location."','".$site_add."','".$city."','".$state."','".$zone."','".$newpanelid."','".$dvrip."','".$dvrname."','".$username."','".$password."','".$live."','".$rtsp."','".$pieusr."','".$piepwd."','".$panelip."','".$alerttype."','".$sn."','".$created_at."') ";
echo $sql;

$sql_insert = mysqli_query($con,$sql);

// if($sql_insert) {echo "12121212";} else { echo "32323232";}
// die;
if($sql_insert){?>

<script>
alert('Data Inserted Successfully');
window.location.href = "view_ai_sites.php";
</script>
<!-- echo "Data Inserted Successfully";
    header('Location: view_ai_sites.php'); -->
<?php }else{?>
<!-- echo "Error inserting data!!!";
    header('Location: ai_sites.php'); -->
<script>
alert('Error Inserting Data!!!');
window.location.href = "ai_sites.php";
</script>
<?php }

// CloseCon($con);
?>