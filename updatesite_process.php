<?php
/*
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	*/
include 'db_connection.php';?>

<?php
$newname="";
$SN=$_POST['SN'];


$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
$ATMID_2=$_POST['ATMID_2'];
$ATMID_3=$_POST['ATMID_3'];
$ATMID_4=$_POST['ATMID_4'];
//echo $ATMID_3;die;
$TrackerNo=$_POST['TrackerNo'];
$ATMShortName=$_POST['ATMShortName'];
$SiteAddress=$_POST['SiteAddress'];
 $City=$_POST['City'];
// $GSM=$_POST['GSM'];
 $State=$_POST['State'];
$Zone=$_POST['Zone'];
$Panel_Make=$_POST['Panel_Make'];
// echo $Panel_Make;die;
$OldPanelID=$_POST['OldPanelID'];
$NewPanelID=$_POST['NewPanelID'];
$DVRIP=$_POST['DVRIP'];
$DVRName=$_POST['DVRName'];

$PanelIP=$_POST['PanelIP'];
$DVR_Model_num=$_POST['DVR_Model_num'];
$Router_Model_num=$_POST['Router_Model_num'];

$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$eng_name=$_POST['eng_name'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");


$site_remark=$_POST['site_remark'];
$live=$_POST['live'];
$RouterIp=$_POST['RouterIp'];

$con = OpenCon();
// $username = 'Test';
// $sql= "UPDATE `sites` SET `RouterIp`='".$RouterIp."',`Customer`='".$Customer."',`Bank`='".$Bank."', `ATMID`='".$ATMID."', `ATMID_2`='".$ATMID_2."', `ATMID_3`='".$ATMID_3."', `ATMID_4`='".$ATMID_4."',`TrackerNo`='".$TrackerNo."',`ATMShortName`='".$ATMShortName."',`SiteAddress`='".$SiteAddress."',`State`='".$State."',`City`='".$City."',`Zone`='".$Zone."',`Panel_Make`='".$Panel_Make."',`OldPanelID`='".$OldPanelID."',`NewPanelID`='".$NewPanelID."',`DVRIP`='".$DVRIP."',`PanelsIP`='".$PanelsIP."',`DVRName`='".$DVRName."',`DVR_Model_num`='".$DVR_Model_num."',`Router_Model_num`='".$Router_Model_num."',`UserName`='".$UserName."',`Password`='".$Password."',`engname`='".$engname."',`live`='".$live."', `remark`='".$remark."',`partial_live`='1'; where `SN`='".$SN."'";
$sql= " UPDATE `sites` SET `ATMID`='".$ATMID."',`ATMID_2`='".$ATMID_2."',`ATMID_3`='".$ATMID_3."',`ATMID_4`='".$ATMID_4."',`TrackerNo`='".$TrackerNo."',`ATMShortName`='".$ATMShortName."',`OldPanelID`='".$OldPanelID."',`NewPanelID`='".$NewPanelID."',`SiteAddress`='".$SiteAddress."',`DVRIP`='".$DVRIP."',`DVRName`='".$DVRName."',`PanelIP`='".$PanelIP."',`DVR_Model_num`='".$DVR_Model_num."',`Router_Model_num`='".$Router_Model_num."',`eng_name`='".$eng_name."',`live`='".$live."',`site_remark`='".$site_remark."',`Password`='".$Password."',`State`='".$State."',`City`='".$City."',`Zone`='".$Zone."',`Panel_Make`='".$Panel_Make."' where `SN`='".$SN."' ";

$result=mysqli_query($con,$sql);
CloseCon($con);
// echo $result;die;
if($result==1){ ?>
  <script>
alert("updated successfully");
window.location.href="viewsitenew.php";
        </script>
<?php }
//$last=mysqli_insert_id($con);

?>


