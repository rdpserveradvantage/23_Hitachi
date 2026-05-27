<?php

function OpenFTPCon()
{

    $ftp_server = "198.38.84.10";
    $ftp_username = "hitachi@sarmicrosystems.in";
    $ftp_userpass = "Hitachi@2022#";
    $ftp_port = "21";
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

function OpenCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "esurv";
    $db_port = '3306';
// $port = "3308";
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);

    return $conn;
}

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


function CloseCon($conn)
 {
 $conn -> close();
 }
