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
$created_by = $_SESSION['userid'];

$po_id = $_POST['purchase_id'];
$sitename = $_POST['sitename'];
$startdate = $_POST['startdate'];
$completedate = $_POST['completedate'];
$total_penalty = $_POST['total_penalty'];
$extented_week = $_POST['extented_week'];
$created_at = date("Y-m-d H:i:s");


$sites_insert = mysqli_query($con,"insert into esurv_po_sites (`po_id`, `site_name`, `completion_date`, `start_date`, `total_penalty`, `no_of_week_extended`, `created_by`, `created_at`) values ( '".$po_id."', '".$sitename."',  '".$completedate."', '".$startdate."', '".$total_penalty."', '".$extented_week."', '".$created_by."', '".$created_at."') ");
CloseCon($con);
if($sites_insert)
{ ?>
   <script>
       swal("Success!", "Inserted Successfully !", "success");

           setTimeout(function(){ 
               window.location.href="po_site_list.php";
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