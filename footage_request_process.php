<?php

include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');
    $atmid = $_POST['atmid'];
    $cardno = $_POST['cardno'];
    $dateoftxn = $_POST['dateoftxn'];
    $timeoftxn = $_POST['timeoftxn'];
        $newTime = date("H:i", strtotime("$timeoftxn"));
        // echo $newTime; die;
    $natureoftxn = $_POST['natureoftxn']; 
    $amountoftxn = $_POST['amountoftxn'];
    $txnnumber = $_POST['txnnumber'];
    $complaint_no = $_POST['complaint_no'];
    $complaint_date = $_POST['complaint_date'];
    $claim_date = $_POST['claim_date'];
    $created_at = date('Y-m-d H:i:s');
	
	$start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
	
  //  $updated_at = date('Y-m-d');
  
$con = OpenCon();
//$sql = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`, `updated_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."','".$updated_at."') ";
$sql = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `start_time`, `end_time`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."', '".$start_time."', '".$end_time."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."') ";
 
$result = mysqli_query($con,$sql);
// echo $result;die;
CloseCon($con);
if($result)
{
    echo '<script>alert("Data Inserted")</script>';
    echo '<script>window.location="footage_request_list.php"</script>';
}
else{ ?>

    <script>
    debugger;
        alert("Something Wrong");
        window.location.href="footage_request.php";

    </script>
<?php }

?>