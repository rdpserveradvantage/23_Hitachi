<?php
include 'db_connection.php';
$con = OpenCon();
//mysqli_query($con,"TRUNCATE TABLE sites_atmid2");

$siteusers_sql = "select * from sites_atmid2";
$siteusers_list = mysqli_query($con, $siteusers_sql);
$site_count = 0;
if (mysqli_num_rows($siteusers_list) > 0) { 
    while ($sitelist = mysqli_fetch_assoc($siteusers_list)) {
        $site_sn = $sitelist['SN'];
        $site_atmid = $sitelist['ATMID']; 
        $site_bank = $sitelist['Bank'];
        $sites_sql = "select * from sites where ATMID_2='".$site_atmid ."'";
        $sites_list_1 = mysqli_query($con, $sites_sql);
        $sites_list = mysqli_fetch_assoc($sites_list_1);
        $atmid = $sites_list['ATMID']; 
        $sitecircle_sql = "select * from site_circle_new where ATMID='".$atmid ."'";
        $sitecircle_list_1 = mysqli_query($con, $sitecircle_sql);
        $sitecircle_list = mysqli_fetch_assoc($sitecircle_list_1);
        $site_type = $sitecircle_list['site_type'];
        $site_zone = $sitecircle_list['Zonal'];
        $site_circle = $sitecircle_list['Circle'];
        $site_count = $site_count + 1;
		$siteset_sql = "INSERT INTO `site_circle_new` (ATMID,site_type,Bank,Zonal,Circle) values ('".$site_atmid."','".$site_type."','".$site_bank."','".$site_zone."','".$site_circle."')";
	   // echo $siteset_sql; die;
		$siteset_result = mysqli_query($con, $siteset_sql);
    }
} 

echo $site_count;

?>