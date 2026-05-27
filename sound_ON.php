<?php 
include("config.php");

$value=$_POST['value'];

date_default_timezone_set("Asia/Kolkata");
$dt= date("Y-m-d h:i:s");

if($value=="soundon"){
mysqli_query($con,"update ButtonAction set sound=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('Sound ON','".$dt."',0)");
if($q){echo 1;}else{echo 0;}

}
else if($value=="ac1on"){
mysqli_query($con,"update ButtonAction set ac1=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('AC1 ON','".$dt."',0)");
if($q){echo 2;}else{echo 0;}

}
else if($value=="ac2on"){
mysqli_query($con,"update ButtonAction set ac2=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('AC2 ON','".$dt."',0)");
if($q){echo 3;}else{echo 0;}

}
else if($value=="ATMon"){
mysqli_query($con,"update ButtonAction set ATM=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('ATM ON','".$dt."',0)");
if($q){echo 4;}else{echo 0;}

}

else if($value=="LIGHTon"){
mysqli_query($con,"update ButtonAction set LIGHT=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('LIGHT ON','".$dt."',0)");
if($q){echo 5;}else{echo 0;}

}
else if($value=="SHUTTER OPEN"){
mysqli_query($con,"update ButtonAction set SHUTTER=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('SHUTTER OPEN','".$dt."',0)");
if($q){echo 6;}else{echo 0;}

}
else if($value=="START TALK"){
mysqli_query($con,"update ButtonAction set TALK=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('START TALK','".$dt."',0)");
if($q){echo 7;}else{echo 0;}

}
else if($value=="ARM"){
mysqli_query($con,"update ButtonAction set ARM=1 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('ARM','".$dt."',0)");
if($q){echo 8;}else{echo 0;}

}


?>