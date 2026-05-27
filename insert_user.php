<?php

include "db_connection.php";

//date_default_timezone_set('Asia/Kolkata');

$conn = OpenCon();
//if($conn) {var_dump($_POST); }else {echo 'error';} die;

// var_dump($_POST); die;
$name = $_POST['name'];
$username = $_POST['usrname'];
$password = $_POST['pwd'];


$created_at = date('Y-m-d H:i:s');

$sql = "insert into loginusers(`name`,`uname`,`pwd`,`permission`,`designation`,`level`,`cust_id`,`bank_id`,`branch`,`zone`) values ('".$name."','".$username."','".$password."','','','','','','','') ";
//var_dump($sql);
//die;

$sql_insert = mysqli_query($conn,$sql);

if($sql_insert){?>

<script>
alert('Data Inserted Successfully');
window.location.href = "add_user.php";
</script>

<?php }else{?>

<script>
alert('Error Inserting Data!!!');
window.location.href = "add_user.php";
</script>
<?php }

CloseCon($conn); 
?>