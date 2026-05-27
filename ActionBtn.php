<?php
include("config.php");

$query=mysqli_query($conn,"SELECT * FROM `ButtonAction` ");
$row=mysqli_fetch_array($query);

echo $row['sound']."@#".$row['ac1']."@#".$row['ac2']."@#". $row['ATM']."@#". $row['LIGHT']."@#".$row['SHUTTER'];



?>