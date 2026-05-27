<?php include('db_connection.php');
    $conn = OpenCon();
	$value=$_POST['id'];
	$dataarray = $_POST['atm_id_list'];
	$_data = [];
	if(count($dataarray)>0){
		$dataarray=json_encode($dataarray);
		$dataarray=str_replace( array('[',']','"') , ''  , $dataarray);
		$atmarr=explode(',',$dataarray);
		$dataarray = "'" . implode ( "', '", $atmarr )."'";
		
		if($value=="hdd"){
			$qrys=mysqli_query($conn,"select * from dvr_health_comfort where hdd IN ('error','notexist','Not Exist','smartFailed','unformatted','No Disk','No disk/idle','abnormal') AND atmid IN (".$dataarray.")");
		}
		 
		 else if($value=="notlogin"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where status='1' and login_status='1'  and live='y'  AND atmid IN (".$dataarray.") ");
		 }
		 else if($value=="Cam1"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam1='not working'  AND atmid IN (".$dataarray.") ");
		 }
		 else if($value=="Cam2"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam2='not working'  AND atmid IN (".$dataarray.")  ");
		 }
		 else if($value=="Cam3"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam3='not working'  AND atmid IN (".$dataarray.") ");
		 }
		 else if($value=="Cam4"){
		 $qrys=mysqli_query($conn,"select * from dvr_health_comfort where cam4='not working'  AND atmid IN (".$dataarray.") ");
		 }
		 
		 
		 
		 
		 while($row = mysqli_fetch_array($qrys)) { 

			$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank,Customer from sites where ATMID='".$row['atmid']."'");
			$fetchState=mysqli_fetch_array($StateQry);

			//$numQry= mysqli_query($conn,"select id from dvr_health_comfort where status='1' and login_status='1' and id='".$row['id']."' ");
			//$num=mysqli_num_rows($numQry);


			if($row[11]!="0000-00-00 00:00:00"){
				$currdat=date("Y-m-d");
				$date1=date_create($currdat);
				$date2=date_create($row[11]);
				$diff=date_diff($date1,$date2);
				$datedif_cnt=$diff->format("%a days");

			}else{$datedif_cnt="NA";}
			
				$data_arr = [];
				$data_arr['site_address'] = $fetchState['SiteAddress'];
				$data_arr['bank'] = $fetchState['Bank'];
				$data_arr['customer'] = $fetchState['Customer'];
				$data_arr['city'] = $fetchState['City'];
				$data_arr['state'] = $fetchState['State'];
				$data_arr['atm_id'] = $row['atmid'];
				$data_arr['hdd'] = $row['hdd'];
				array_push($_data,$data_arr);

				$code = 200;
			}
	}else{
		$code = 201;
	}
	$array = array(['res_data'=>$_data,'code'=>$code]);
	CloseCon($conn);
	echo json_encode($array);
	
?>