<?php
include('../../db_connection.php');


$ftp_conn = OpenFTPCon();
$ftp_pasv = ftp_pasv($ftp_conn,true);

//$file = "AI_Feed/D2142120/2022_04_24/14/2022-04-24_14_06_06.avi";
$file = $_GET['file'];
//echo $file;die;
$size = ftp_size($ftp_conn, $file);

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . basename($file));
header("Content-Length: $size"); 

ftp_get($ftp_conn, "php://output", $file, FTP_BINARY);


?>