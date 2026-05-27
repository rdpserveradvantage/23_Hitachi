<?php
include('db_connection.php');


$ftp_conn = OpenFTPCon();
$ftp_pasv = ftp_pasv($ftp_conn,true);

$filename = "AI_Feed/D2142120/2022_04_24/14/2022-04-24_14_06_06.avi";
//$file = $_GET['file'];
//echo $file;die;
//$size = ftp_size($ftp_conn, $file);

define('CHUNK_SIZE', 1024*1024); // Size (in bytes) of tiles chunk

// Read a file and display its content chunk by chunk
function readfile_chunked($filename, $retbytes = TRUE) {
    $buffer = '';
    $cnt    = 0;
    $handle = fopen($filename, 'rb');

    if ($handle === false) {
        return false;
    }

    while (!feof($handle)) {
        $buffer = fread($handle, CHUNK_SIZE);
        echo $buffer;
        ob_flush();
        flush();

        if ($retbytes) {
            $cnt += strlen($buffer);
        }
    }

    $status = fclose($handle);

    if ($retbytes && $status) {
        return $cnt; // return num. bytes delivered like readfile() does.
    }

    return $status;
}


   // $mimetype = 'video/x-msvideo';
    //header('Content-Type: '.$mimetype );
    //readfile_chunked($filename);
	
	//$filename = "path/to/your/file";
    header("X-Sendfile: ".$filename);
/*
if ($logged_in) {
   $filename = 'path/to/your/file';
    $mimetype = 'mime/type';
    header('Content-Type: '.$mimetype );
    readfile_chunked($filename);

} else {
    echo 'Tabatha says you haven\'t paid.';
} */
?>