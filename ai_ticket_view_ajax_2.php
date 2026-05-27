<?php session_start(); include('db_connection.php'); 

// initilize all variable
	$params = $columns = $totalRecords = $data = array();

	$params = $_REQUEST;

	//define index of column
	$columns = array( 
		0 =>'id',
		1 =>'location', 
		2 => 'atmid',
		3 => 'alert_type',
		4 =>'createdatetime', 
		5 => 'dvrip',
		6 => 'alarm_status',
		7 =>'action'
	);

	$where = $sqlTot = $sqlRec = "";
	
	
	// check search value exist
	if( !empty($params['search']['value']) ) {   
		$where .=" WHERE ";
		$where .=" ( ATMID LIKE '".$params['search']['value']."%' ";    
		//$where .=" OR panelid LIKE '".$params['search']['value']."%' ";

		//$where .=" OR location LIKE '".$params['search']['value']."%' )";
	}

    $client = $params['client'];
	$banks = explode(",",$_SESSION['bankname']);
		   $_bank_name = [];
		   for($i=0;$i<count($banks);$i++){
			   $_bank = explode("_",$banks[$i]);
			   if($_bank[0]==$client){
				   array_push($_bank_name,$_bank[1]);
			   }
		   } 
			$_bank_name=json_encode($_bank_name);
			$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
			$bankarr=explode(',',$_bank_name);
			$_bank_name = "'" . implode ( "', '", $bankarr )."'";

	 $bank = "";
	   $atmid = "";
	if(isset($params['bank'])){
	$bank = $params['bank'];
	}
	if(isset($params['circle'])){
	$circle = $params['circle'];
	}
	if(isset($params['atmid'])){
	$atmid = $params['atmid'];
	}
	$con = OpenCon();

	$atmidarray = [];
	
if($atmid!=''){
		$sitesql = mysqli_query($con,"select ATMID from sites where ATMID='".$atmid."' and live='Y'");
	}else{
		if($bank!=''){
			if($circle!=''){
					$circlesql = mysqli_query($con,"select ATMID from site_circle where Circle='".$circle."'");
					$circleatmidarray = [];
					while($circlesql_result = mysqli_fetch_assoc($circlesql)){
						$circleatmidarray[] = $circlesql_result['ATMID'];
						
					}
					$circleatmidarray=json_encode($circleatmidarray);
					$circleatmidarray=str_replace( array('[',']','"') , ''  , $circleatmidarray);
					$circlearr=explode(',',$circleatmidarray);
					$circleatmidarray = "'" . implode ( "', '", $circlearr )."'";
					$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and ATMID IN (".$circleatmidarray.") and live='Y'");	
				}else{ 
					 $sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank='".$bank."' and live='Y'");
				} 
		 
		}else{
			$sitesql = mysqli_query($con,"select ATMID from sites where Customer='".$client."' and Bank IN (".$_bank_name.") and live='Y'");
		}
		
	}
	$atmidarray = [];
while($sitesql_result = mysqli_fetch_assoc($sitesql)){
		$atmidarray[] = " ".$sitesql_result['ATMID'];
	}
	if(count($atmidarray)>0){
		$atmidarray=json_encode($atmidarray);
		$atmidarray=str_replace( array('[',']','"') , ''  , $atmidarray);
		$arr=explode(',',$atmidarray);
		$atmidarray = "'" . implode ( "', '", $arr )."'";
	}

		
		
	$start_date= $params['start_date'];
	$end_date = $params['end_date'];
	$portal = $params['portal'];


if($portal=="all"){
   $sql = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."'"; 
}else{
	if($portal=="active"){
		$sql = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."' AND status='O'"; 
	}else{
		$sql = "select * from ai_alerts where ATMCode IN (".$atmidarray.") AND alerttype NOT LIKE '%alive%' AND CAST(createtime AS DATE)>='".$start_date."' AND CAST(createtime AS DATE)<='".$end_date."' AND status='C'"; 
	}
}

	
	//$sql = "SELECT * FROM `employee` ";
	$sqlTot .= $sql;
	$sqlRec .= $sql;
	//concatenate search sql if value exist
	if(isset($where) && $where != '') {

		$sqlTot .= $where;
		$sqlRec .= $where;
	}


 	$sqlRec .=  " ORDER BY ". $columns[$params['order'][0]['column']]."   ".$params['order'][0]['dir']."  LIMIT ".$params['start']." ,".$params['length']." ";

	$queryTot = mysqli_query($con, $sqlTot) or die("database error:". mysqli_error($con));


	$totalRecords = mysqli_num_rows($queryTot);

	$queryRecords = mysqli_query($con, $sqlRec) or die($sqlRec);
    $dataArray = array();

    while( $sql_result = mysqli_fetch_assoc($queryRecords) ) {  
	        $str = $sql_result['File_loc'];
			$_atmid = trim($sql_result['ATMCode']);
			$_dvrip = "-";
			$_siteaddress = "-";
		    $atmsitesql = mysqli_query($con,"select ATMID,DVRIP,SiteAddress from sites where ATMID='".$_atmid."'");
			if(mysqli_num_rows($atmsitesql)>0){
			  $atmsitesql_result = mysqli_fetch_assoc($atmsitesql);
			  $_siteaddress = $atmsitesql_result['SiteAddress'];
			  $_dvrip = $atmsitesql_result['DVRIP'];
			}
			$src = "";
			if($str!=''){
				//$files = explode("/",$str);
				$files = str_replace('./Record','',$str);
				//$file = $files[2];
				$file = str_replace('/','\\',$files);
				$path = "D:\\python_codes\\Server_socket\\Record\\$file";
				/*if(file_exists($path)){
					$imgData = base64_encode(file_get_contents($path)); 
					$src = 'data: '.mime_content_type($path).';base64,'.$imgData; 
				} */
			}
			$_status = 'Closed';
			if($sql_result['status']=='O'){
				$_status = 'Active';
			}
			$_newdata = array();
			$_newdata[] = $sql_result['id'];
			$_newdata[] =  $_siteaddress;
			$_newdata[] = $_atmid;
		    $_newdata[] = $sql_result['alerttype'];
		    $_newdata[] =  $sql_result['createtime'];
		    $_newdata[] =  $_dvrip;
		    $_newdata[] =  $_status ;
		    $_newdata[] =  $src;
		   // $_newdata[] =  $path;
			
			array_push($dataArray,$_newdata);
			
		  }
	 
	 CloseCon($con);
	$json_data = array(
			"draw"            => intval( $params['draw'] ),   
			"recordsTotal"    => intval( $totalRecords ),  
			"recordsFiltered" => intval($totalRecords),
			"data"            => $dataArray   // total data array
			);

	echo json_encode($json_data);  // send data as json format
?>
