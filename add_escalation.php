<?php

include 'config.php';?>
<html>
    <head>

<body>
<?php

$ID = $_POST['AtmID'];
$Type = $_POST['type'];
$Name = $_POST['name'];
$Designation = $_POST['designation'];
$Mobile = $_POST['mobile'];
$Telephone = $_POST['landline'];
$Email = $_POST['email'];
//$Escalation_email = $_POST['escalation_email'];
$Priority = $_POST['priority'];
$Once_interval = $_POST['duration'];
$Repeat_interval = $_POST['repeat_interval'];

$sql="insert into escalation_matrix(type,atmid,name,designation,telephone,mobile,email,priority,once_interval,repeat_interval)
values('$Type','$ID','$Name','$Designation','$Telephone','$Mobile','$Email','$Priority','$Once_interval','$Repeat_interval')";

$result=mysqli_query($con,$sql);


if($result){
 
?>
<script>
alert("Added Successfully");
window.location.href = "escalationlist.php";
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

