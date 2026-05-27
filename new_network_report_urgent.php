<?php
include 'db_connection.php';
$con = OpenCon();
$mon_date = "2023-05-30";
$loginusers_sql = "select * from esurv_network";
$loginusers_list = mysqli_query($con, $loginusers_sql);
$cnt = 0;
if (mysqli_num_rows($loginusers_list) > 0) {
    while ($userlist = mysqli_fetch_assoc($loginusers_list)) {
        $atmid = $userlist['atmid'];
        $id = $userlist['id'];
        $site_sql = "select * from sites where ATMID='".$atmid."'";
        $site_list = mysqli_query($con, $site_sql);
        $s_list = mysqli_fetch_assoc($site_list);
        $SN = $s_list['SN'];
        $percent = $userlist['date_6'];
        $uptime_cal = $percent * 0.24;
        $uptime = ceil($uptime_cal);
       // echo $uptime."_";
        $downtime = 24 - $uptime;
       // echo $downtime;die; 
        $update_qry = "update newnetwork_report SET uptime = '" . $uptime . "',downtime = '" . $downtime . "' where month_date='" . $mon_date . "' AND SN='".$SN."'";
       // echo $update_qry;die;
        $is_update = mysqli_query($con, $update_qry);
        $cnt = $cnt + 1;
      // die;
    }
}
CloseCon($con);
echo $cnt;

/*
$loginusers_sql = "select * from esurv_network";
$loginusers_list = mysqli_query($con, $loginusers_sql);
if (mysqli_num_rows($loginusers_list) > 0) {
    while ($userlist = mysqli_fetch_assoc($loginusers_list)) {
        $date_1 = $userlist['date_1'];
        $id = $userlist['id'];
        
        $update_qry = "update newnetwork_report SET uptime = '" . $uptime . "',downtime = '" . $downtime . "' where month_date='" . $mon_date . "'";
        $is_update = mysqli_query($con, $update_qry);
        $is_update;
       
    }
}
*/