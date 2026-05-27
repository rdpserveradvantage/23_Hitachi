<?php
include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');
    $id = $_POST['id'];   
    $footage_avail = $_POST['footage_avail'];
    $footage_filename = $_POST['footage_filename'];
    $footage_date = $_POST['footage_date'];
    $footage_start_time = $_POST['footage_start_time'];
     $footage_start_time = date("H:i", strtotime($footage_start_time));
	$footage_end_time = $_POST['footage_end_time'];
      $footage_end_time = date("H:i", strtotime($footage_end_time));  
        // echo $newTime; die;
    $date_of_presrv = $_POST['date_of_presrv'];
    $downlink = $_POST['downlink'];
	$status = 1;
    $footage_receive_at = date('Y-m-d H:i:s');
  
$con = OpenCon();
//$sql = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`, `updated_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."','".$updated_at."') ";
$sql= " UPDATE `footage_request` SET `footage_avail`='".$footage_avail."',`footage_filename`='".$footage_filename."',`footage_date`='".$footage_date."',`footage_start_time`='".$footage_start_time."',`footage_end_time`='".$footage_end_time."',`date_of_presrv`='".$date_of_presrv."',`downlink`='".$downlink."', `status`='".$status."', `footage_receive_at`='".$footage_receive_at."' where `id`='".$id."' ";

$result = mysqli_query($con,$sql);
// echo $result;die;
CloseCon($con);
if($result)
{
    $data=['Code'=> 200,'result_msg'=>'Updated Successfully'];
}
else{ 
    $data=['Code'=> 201,'result_msg'=>'UnSuccessfully. Something Went Wrong'];
 }
echo json_encode($data);
?>