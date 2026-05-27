<?php

include "db_connection.php";

date_default_timezone_set('Asia/Kolkata');

$con = OpenCon();
// var_dump($_POST); die;
$site_id = $_POST['site_id'];

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

// $created_at = date('Y-m-d H:i:s');
$updated_at = date('Y-m-d H:i:s');


$updated_sql = "UPDATE `ai_sites` SET `Project`='".$project."',`Customer`='".$customer."',`Bank`='".$bank."',`ATMID`='".$atmid."',`Location`='".$location."',`SiteAddress`='".$site_add."',`City`='".$city."',`State`='".$state."',`Zone`='".$zone."',`NewPanelID`='".$newpanelid."',`DVRIP`='".$dvrip."',`DVRName`='".$dvrname."',`UserName`='".$username."',`Password`='".$password."',`live`='".$live."',`rtsp_stream`='".$rtsp."',`pie_username`='".$pieusr."',`pie_pwd`='".$piepwd."',`PanelIP`='".$panelip."',`AlertType`='".$alerttype."',`SN`='".$sn."',`updates_at`='".$updated_at."' WHERE id='".$site_id."' ";

// die;
$sql_update = mysqli_query($con,$updated_sql);

if($sql_update){ ?>
<script>
alert('Data Updated Successfully');
window.location.href = "view_ai_sites.php";
</script>

<?php } else { ?>
<script>
alert('Error Updating');
window.location.href = "view_ai_sites.php";
</script>

<?php  }

// CloseCon($con);
?>