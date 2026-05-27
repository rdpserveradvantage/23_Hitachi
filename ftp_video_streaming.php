<?php
include('db_connection.php');
$filepath = $_GET["file"];

$ftp_conn = OpenFTPCon();
$ftp_pasv = ftp_pasv($ftp_conn,true);

//$filename = "AI_Feed/D2142120/2022_04_24/14/2022-04-24_14_06_06.avi";

include_once("video_stream_class.php"); // when include_path is set or else use require_once

$stream = new VideoStream($filepath); 
$stream->start();
exit;

?>