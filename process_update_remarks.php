<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
    </head>
    <body>
        

<?php
session_start();
include('db_connection.php');
$con = OpenCon();
date_default_timezone_set('Asia/Kolkata');
$created_at = date('Y-m-d H:i:s');
$created_by = $_SESSION['userid'];
$atmid = $_POST['atmid'];
$SN = $_POST['SN'];    
$remarks = $_POST['remarks'];   
$is_insert = $_POST['is_insert'];

//echo '<pre>';print_r($_POST);echo '</pre>';die;

if($is_insert == 1){
   $sql = " INSERT INTO `site_details_remark`( `SN`, `atmid`, `remarks`, `created_by`, `created_at`) VALUES ('".$SN."','".$atmid."','".$remarks."','".$created_by."','".$created_at."') ";
}else{
   $sql= " UPDATE `site_details_remark` SET `remarks`='".$remarks."' where `SN`='".$SN."' ";
}

$result=mysqli_query($con,$sql);

CloseCon($con);
if($result){
?>
 <script>
       swal("Great!", "Remarks Updated Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="viewsitenew.php";
           }, 3000);

       </script> 
<?php }else{ ?>	   
 <script>
       swal("Something Wrong", "Sorry, there was an error !", "error");
          // swal('error','','Error');
           setTimeout(function(){ 
		     window.location.href="viewsitenew.php";
             // window.history.back();
           }, 3000);

       </script>

<?php }?>
 
</body>
</html>