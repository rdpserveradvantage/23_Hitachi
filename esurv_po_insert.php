<?php session_start();
include('db_connection.php');
date_default_timezone_set('Asia/Kolkata');
$con = OpenCon(); ?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>        
    </head>
    <body>
        
<?php
$order_no = $_POST['po_no'];
$order_date = $_POST['po_date'];
$client_name = $_POST['client_name'];
$project_name = $_POST['proj_name'];
$penalty = $_POST['penalty'];

$created_by = $_SESSION['userid'];
$expected_date  = date("Y-m-d", strtotime($_POST['expected_date']));
$created_at = date("Y-m-d H:i:s");

$sql = mysqli_query($con,"insert into esurv_po (`po_number`, `po_date`, `client`, `proj_name`, `expected_completion_date`, `penalty`, `created_by`, `created_at`) values('".$order_no."','".$order_date."','".$client_name."','".$project_name."','".$expected_date."','".$penalty."','".$created_by."','".$created_at."')");
CloseCon($con);
if($sql){
 ?>
   <script>
       swal("Success!", "Inserted Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="po_list.php";
           }, 3000);

       </script> 

<?php } else
{
?>
<script>
       swal("Error", "Login Error !", "error");
           swal('error','','Login Error');
           setTimeout(function(){ 
              window.history.back();
           }, 3000);

       </script>
<?php
}
?>
 </body>
</html>