<?php

include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');
//echo '<pre>';print_r($_POST);echo '</pre>';die;
    $id = $_POST['id'];   
    $footage_avail = $_POST['footage_avail'];
    $status = 1;
    $footage_receive_at = date('Y-m-d H:i:s');
    $downlink = $_POST['downlink'];
	if($downlink!=""){
	  $downloadlink = json_encode($downlink);
	  $sql= " UPDATE `footage_request` SET `footage_avail`='".$footage_avail."',`downlink`='".$downlink."', `status`='".$status."', `footage_receive_at`='".$footage_receive_at."' where `id`='".$id."' ";
	}else{
	  $sql= " UPDATE `footage_request` SET `footage_avail`='".$footage_avail."',`status`='".$status."', `footage_receive_at`='".$footage_receive_at."' where `id`='".$id."' ";
	
	}
	
  
$con = OpenCon();
//$sql = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`, `updated_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."','".$updated_at."') ";

$result = mysqli_query($con,$sql);
// echo $result;die;
CloseCon($con);
if($result)
{
    echo '<script>alert("Data Inserted")</script>';
    echo '<script>window.location="footage_request_list_new.php.php"</script>';
}
else{ ?>

    <script>
    debugger;
        alert("Something Wrong");
        window.location.href="footage_request_list_new.php.php";

    </script>
<?php }

?>