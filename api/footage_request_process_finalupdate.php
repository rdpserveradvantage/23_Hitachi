<?php

include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');
    $id = $_POST['id'];   
   
    $status = $_POST['status'];
	
  
$con = OpenCon();
//$sql = " INSERT INTO `footage_request`( `atmid`, `card_no`, `date_of_TXN`, `time_of_TXN`, `nature_of_TXN`, `amount_of_TXN`, `txn_no`, `complaint_no`, `complaint_date`, `claim_date`, `created_at`, `updated_at`) VALUES ('".$atmid."','".$cardno."','".$dateoftxn."','".$newTime."','".$natureoftxn."','".$amountoftxn."','".$txnnumber."','".$complaint_no."','".$complaint_date."','".$claim_date."','".$created_at."','".$updated_at."') ";
$sql= " UPDATE `footage_request` SET `status`='".$status."' where `id`='".$id."' ";

$result = mysqli_query($con,$sql);
// echo $result;die;
CloseCon($con);
if($result)
{
    $data=['Code'=> 200,'result_msg'=>'Request Closed Successfully'];
}
else{ 
    $data=['Code'=> 201,'result_msg'=>'Closed UnSuccessfully. Something Went Wrong'];
 }
echo json_encode($data);
?>