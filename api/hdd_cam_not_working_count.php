<?php include('db_conection.php');
        $con = OpenCon();
        $Q4="select count(*) as totalError from dvr_health where hdd='error'";
		$errorqry=mysqli_query($con,$Q4);
		$fetcherrorQry=mysqli_fetch_array($errorqry);
                                            
                                            
		$Q5="select count(*) as totalNotExist from dvr_health where hdd='notexist' or hdd='Not Exist' ";
		$notexistqry=mysqli_query($con,$Q5);
		$fetchNotExistQry=mysqli_fetch_array($notexistqry);
		
		
		$Q6="select count(*) as totalSmartFailed from dvr_health where hdd='smartFailed' ";
		$smartFailedqry=mysqli_query($con,$Q6);
		$fetchsmartFailedQry=mysqli_fetch_array($smartFailedqry);
		
		$Q61="select count(*) as totalAbNormal from dvr_health where hdd='abnormal' ";
		$abnormalqry=mysqli_query($con,$Q61);
		$fetchabNormalQry=mysqli_fetch_array($abnormalqry);
		
		$Q62="select count(*) as totalNoDisk from dvr_health where hdd='No Disk' or hdd='No disk/idle' ";
		$noDiskqry=mysqli_query($con,$Q62);
		$fetchnoDiskQry=mysqli_fetch_array($noDiskqry);
		
		
		$Q7="select count(*) as totalUnformatted from dvr_health where hdd='unformatted' ";
		$unformattedqry=mysqli_query($con,$Q7);
		$fetchunformattedQry=mysqli_fetch_array($unformattedqry);
		if($_SESSION['designation']=="4"){
			echo "0/0/0/3";
		}else{
		echo $fetcherrorQry['totalError'] . " / " .  $fetchNotExistQry['totalNotExist']. " / " .$fetchsmartFailedQry['totalSmartFailed'] . " / " .  $fetchunformattedQry['totalUnformatted'] ."</br> / " . $fetchabNormalQry['totalAbNormal'] ." / " . $fetchnoDiskQry['totalNoDisk'];
		} 