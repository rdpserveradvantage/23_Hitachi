<?php
session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

 $current_datetime = date('Y-m-d H:i:s');
 
$id = $_SESSION['userid'];

if (isset($_GET['path'])) {
//Read the filename
    $filename = $_GET['path'];
	
	$filters = "Footage Start Zip Download Path : ".$filename;
	
	$description = $filters;
 
    $set_sql = "INSERT INTO `user_activity_logs`( `user_id`,`activity_description`, `created_at`,`site_url`) VALUES ('".$id."','".$description."','".$current_datetime."','Hitachi') ";
    $set_result = mysqli_query($con,$set_sql); 

    CloseCon($con);
	
//Check the file exists or not
    if (file_exists($filename)) {
		
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-type: application/octet-stream");
		header('Content-Disposition: attachment; filename="'. basename($filename) .'"');
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".filesize($filename));
		ob_end_flush();

//Define header information
       /* header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Cache-Control: no-cache, must-revalidate");
        header("Expires: 0");
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        header('Content-Length: ' . filesize($filename));
        header('Pragma: public'); */

//Clear system output buffer
      //  flush();

//Read the size of the file
        @readfile($filename);

//Terminate from the script
        die();
    } else {
        echo "File does not exist.";
    }
} else {
    echo "Filename is not defined."
    ;
}
