<?php

if (!function_exists('OpenCon')) {
function OpenCon(){
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "esurv";
// $port = "3308";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }

    }
 

if (!function_exists('OpenComsarmiCon')) {

 function OpenComsarmiCon()
 {
 $dbhost = "localhost";
 $dbuser = "comsarmi_DVR";
 $dbpass = "sar@1234";
 $db = "comsarmi_dvr_data";
// $port = "3308";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
}
 
if (!function_exists('OpenNewCon')) {

 function OpenNewCon()
 {
 $dbhost = "192.168.100.21";
 $dbuser = "esurv";
 $dbpass = "Esurv123*";
 $db = "esurv";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
}
 
if (!function_exists('CloseCon')) {

function CloseCon($conn)
 {
 $conn -> close();
 }
}
 
if (!function_exists('OpenFTPCon')) {

 function OpenFTPCon()
 {
// $ftp_server = "103.141.218.26";
 //$ftp_username = "css";
//$ftp_userpass = "Comfort@#1212";
//$ftp_port = "252";
//$ftp_server = "192.168.72.2"; 
//$ftp_server = "192.168.100.18";
$ftp_server = "192.168.100.26"; 
$ftp_username = "comfort_cloud";
$ftp_userpass = "cam@12345";
$ftp_port = "7553";
$timeout = "90";
$ftp_conn = ftp_connect($ftp_server,$ftp_port,$timeout) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
//var_dump($ftp_conn);
// check connection
if ((!$ftp_conn) || (!$login)) {
      echo "FTP connection has failed!";
      echo "Attempted to connect to $ftp_server for user $ftp_username";
      die;
  } else {
     // echo "Connected to $ftp_server, for user $ftp_username";
  }
 
 return $ftp_conn;
 }
}
 

 if (!function_exists('OpenComfortFTPCon')) {
 function OpenComfortFTPCon()
 {
// $ftp_server = "103.141.218.26";
 //$ftp_username = "css";
//$ftp_userpass = "Comfort@#1212";
//$ftp_port = "252";
$ftp_server = "192.168.72.2"; 
//$ftp_server = "192.168.100.18";
$ftp_username = "comfort";
$ftp_userpass = "cam@12345";
$ftp_port = "7554";
$timeout = "90";
$ftp_conn = ftp_connect($ftp_server,$ftp_port,$timeout) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
//var_dump($ftp_conn);
// check connection
if ((!$ftp_conn) || (!$login)) {
      echo "FTP connection has failed!";
      echo "Attempted to connect to $ftp_server for user $ftp_username";
      die;
  } else {
     // echo "Connected to $ftp_server, for user $ftp_username";
  }
 
 return $ftp_conn;
 }
}
 
 if (!function_exists('OpenComfortFTPLocalCon')) {

 function OpenComfortFTPLocalCon()
 {
// $ftp_server = "103.141.218.26";
 //$ftp_username = "css";
//$ftp_userpass = "Comfort@#1212";
//$ftp_port = "252";
$ftp_server = "192.168.100.26"; 
//$ftp_server = "192.168.100.18";
$ftp_username = "comfort";
$ftp_userpass = "cam@12345";
$ftp_port = "7554";
$timeout = "90";
$ftp_conn = ftp_connect($ftp_server,$ftp_port,$timeout) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
//var_dump($ftp_conn);
// check connection
if ((!$ftp_conn) || (!$login)) {
      echo "FTP connection has failed!";
      echo "Attempted to connect to $ftp_server for user $ftp_username";
      die;
  } else {
     // echo "Connected to $ftp_server, for user $ftp_username";
  }
 
 return $ftp_conn;
 }
 
 }

 if (!function_exists('OpenVisitFTPCon')) {

 function OpenVisitFTPCon()
{

    $ftp_server = "103.141.218.26";
    $ftp_username = "css";
    $ftp_userpass = "Comfort@#1212";
    $ftp_port = "521";
    $timeout = "90";
    $ftp_conn = ftp_connect($ftp_server, $ftp_port, $timeout) or die("Could not connect to $ftp_server");
    $login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);

// check connection
    if ((!$ftp_conn) || (!$login)) {
        echo "FTP connection has failed!";
        echo "Attempted to connect to $ftp_server for user $ftp_username";
        die;
    } else {
        // echo "Connected to $ftp_server, for user $ftp_username";
    }

    return $ftp_conn;
}
   }
?>