<?php

include 'config.php';
$newname="";
$Status=$_POST['Status'];
$Phase=$_POST['Phase'];
$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
$ATMID_2=$_POST['ATMID_2'];
$ATMID_3=$_POST['ATMID_3'];
$ATMID_4=$_POST['ATMID_4'];
$TrackerNo=$_POST['TrackerNo'];
$ATMShortName=$_POST['ATMShortName'];
$SiteAddress=$_POST['SiteAddress'];
 $City=CityName($_POST['city']);
 $State=StateName($_POST['State']);
$Zone=$_POST['Zone'];
$Panel_Make=$_POST['Panel_Make'];
$OldPanelID=$_POST['OldPanelID'];
$NewPanelID=$_POST['NewPanelID'];
$DVRIP=$_POST['DVRIP'];
$PanelsIP=$_POST['PanelsIP'];
$DVRName=$_POST['DVRName'];
$DVR_Model_num=$_POST['DVR_Model_num'];
$Router_Model_num=$_POST['Router_Model_num'];

$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$engname=$_POST['engname'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_POST['dates'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}
$remark=$_POST['Remark'];
$RouterIp=$_POST['RouterIp'];


$live=$_POST['live'];




$username = 'Test';
//$username = $_SESSION['name'];
$sql="insert into sites(Status,Phase,Customer,Bank,TrackerNo,ATMID,ATMID_2,ATMID_3,ATMID_4,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,RouterIp,partial_live)
values('".$Status."','".$Phase."','".$Customer."','".$Bank."','".$TrackerNo."','".$ATMID."','".$ATMID_2."','".$ATMID_3."','".$ATMID_4."','".$ATMShortName."','".$SiteAddress."','".$City."','".$State."','".$Zone."','".$Panel_Make."','".$OldPanelID."','".$NewPanelID."','".$DVRIP."','".$DVRName."','".$UserName."','".$Password."','".$live."','".$curentdt."','".$instdt.$t."','".$engname."','".$username."','".$remark."','".$DVR_Model_num."','".$Router_Model_num."','".$PanelsIP."','".$RouterIp."','1')";

$result=mysqli_query($con,$sql) OR die(mysqli_error($con)); 

// echo $result;die;
 
$last=mysqli_insert_id($con);

if($last){
 
?>
<script>
alert("register successfully");
window.location.href = "sitelist.php";
        </script>
<script>


</script> 

</body>
</html>

<?php
		}else{
			echo '<script>alert("Error");</script>';
			
		}


?>

