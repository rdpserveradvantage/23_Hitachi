<?php
include 'db_connection.php';
$con = OpenCon();
//mysqli_query($con,"TRUNCATE TABLE sites_atmid2");

$loginusers_sql = "select * from sites where Customer='Hitachi' AND Bank='PNB' AND live='Y' AND ATMID NOT IN (SELECT ATMID from sites_atmid2)";
$loginusers_list = mysqli_query($con, $loginusers_sql);
$count = 0;
//echo mysqli_num_rows($loginusers_list);die;
if (mysqli_num_rows($loginusers_list) > 0) {
    while ($userlist = mysqli_fetch_assoc($loginusers_list)) {
        $_is_insert = 0;
        $atmid_2 = $userlist['ATMID_2'];
        $sn = $userlist['SN'];
        if($atmid_2!=''){
            if($atmid_2!='-'){
                $_is_insert = 1;
            }
        }
        
        if($_is_insert==1){
            $count = $count + 1;
            $set_sql = "INSERT INTO `sites_atmid2` SELECT * FROM sites where SN = '".$sn."'";
            $set_result = mysqli_query($con, $set_sql);
        }
    }
}




$siteusers_sql = "select * from sites_atmid2 where ATMID_2 NOT IN (SELECT ATMID from sites where Customer='Hitachi' AND Bank='PNB' AND live='Y')";
$siteusers_list = mysqli_query($con, $siteusers_sql);
$site_count = 0;
if (mysqli_num_rows($siteusers_list) > 0) {
    while ($sitelist = mysqli_fetch_assoc($siteusers_list)) {
        $site_sn = $sitelist['SN'];
        $site_atmid = $sitelist['ATMID_2'];
        //echo $site_sn;die;
        $set_sql = "UPDATE `sites_atmid2` SET `ATMID`='".$site_atmid."', `ATMID_2`='' where SN='" . $site_sn . "'";
        $set_result = mysqli_query($con, $set_sql);
       // echo $set_result;die;
        if($set_result==1){ 
            $site_count = $site_count + 1;
            $siteset_sql = "INSERT INTO `sites` (Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,editby,site_remark,PanelIP,AlertType,live_date,CTS_LocalBranch,RouterIp,last_modified,partial_live,router_port,dvr_nvr_port,panel_port) SELECT Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,DVR_Model_num,Router_Model_num,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,editby,site_remark,PanelIP,AlertType,live_date,CTS_LocalBranch,RouterIp,last_modified,partial_live,router_port,dvr_nvr_port,panel_port FROM sites_atmid2 where SN = '".$site_sn."'";
           // echo $siteset_sql;
            $siteset_result = mysqli_query($con, $siteset_sql);
        }
       // echo $site_count;die; 
    }
} 

?>