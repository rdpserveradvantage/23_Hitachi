<?php 
    include('ftp_server_conn.php');
	
	//$client = $_POST['client'];
	//$userid = $_POST['user_id'];
	
	
    $ftp_conn_local = OpenVisitFTPCon();
	$ftp_pasv_local = ftp_pasv($ftp_conn_local,true);
	$file_list = ftp_nlist($ftp_conn_local, "./visit");
	echo '<pre>';print_r($file_list);echo '</pre>';die;