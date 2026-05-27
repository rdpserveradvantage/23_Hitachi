<?php 
include("config.php");
date_default_timezone_set("Asia/Kolkata");
$dt= date("Y-m-d h:i:s");


$value=$_POST['value'];
if($value=="soundoff"){
mysqli_query($con,"update ButtonAction set sound=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('Sound Off','".$dt."',0)");
if($q){echo 1;}else{echo 0;}

}

else if($value=="ac1off"){
mysqli_query($con,"update ButtonAction set ac1=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('AC1 Off','".$dt."',0)");
if($q){echo 2;}else{echo 0;}

}
else if($value=="ac2off"){
mysqli_query($con,"update ButtonAction set ac2=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('AC2 Off','".$dt."',0)");
if($q){echo 3;}else{echo 0;}

}
else if($value=="ATMoff"){
mysqli_query($con,"update ButtonAction set ATM=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('ATM Off','".$dt."',0)");
if($q){echo 4;}else{echo 0;}

}


else if($value=="LIGHToff"){
mysqli_query($con,"update ButtonAction set LIGHT=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('LIGHT Off','".$dt."',0)");
if($q){echo 5;}else{echo 0;}

}
/*else if($value=="LC1off"){

$q=mysqli_query($conn,"insert into commands (cdesc,ctime,status) values('LC1 Off','".$dt."',0)");
if($q){echo 5;}else{echo 0;}

}
else if($value=="LC2off"){

$q=mysqli_query($conn,"insert into commands (cdesc,ctime,status) values('LC2 Off','".$dt."',0)");
if($q){echo 6;}else{echo 0;}

}
*/
else if($value=="SHUTTER CLOSE"){
mysqli_query($con,"update ButtonAction set SHUTTER=0 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('SHUTTER CLOSE','".$dt."',0)");
if($q){echo 6;}else{echo 0;}
}

else if($value=="SHUTTER STOP"){
mysqli_query($con,"update ButtonAction set SHUTTER=2 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('SHUTTER STOP','".$dt."',0)");
if($q){echo 7;}else{echo 0;}

}

else if($value=="STOP TALK"){
mysqli_query($con,"update ButtonAction set TALK=2 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('STOP TALK','".$dt."',0)");
if($q){echo 8;}else{echo 0;}

}
else if($value=="DISARM"){
mysqli_query($con,"update ButtonAction set ARM=2 ");
$q=mysqli_query($con,"insert into commands (cdesc,ctime,status) values('DISARM','".$dt."',0)");
if($q){echo 9;}else{echo 0;}

}



?>