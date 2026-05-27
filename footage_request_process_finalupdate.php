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
{  ?>
<script>
   swal("Great!", "Updated Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="footage_request_details.php?id=<?php echo $id;?>";
           }, 3000);
   </script>
   <?
}
else{ ?>

    <script>
    swal("Oops!", "Updated UnSuccessfully !", "danger");

           setTimeout(function(){ 
               window.location.href="footage_request_details.php?id=<?php echo $id;?>";
           }, 3000);

    </script>
<?php }

?>