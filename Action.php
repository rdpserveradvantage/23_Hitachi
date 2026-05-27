<?php
include("config.php");

$query=mysqli_query($conn,"SELECT * FROM `commands` where 1=1 order by id desc limit 1");
$fetchID=mysqli_fetch_row($query);

echo $fetchID[1];


?>