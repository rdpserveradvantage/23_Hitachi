<?php include('db_connection.php'); $con = OpenCon();
   $sitesql = "SELECT * FROM `sites` WHERE ATMID IN ('D5012800',
'D1991600',
'D8004000',
'A5293400',
'D1916700',
'N3251400',
'A1174610',
'D1086500',
'D7037500',
'B1051500',
'A1194210',
'D1113420',
'D2494800',
'N3098500',
'D1178920',
'N4158300',
'N3883700',
'B1082710',
'D1195120',
'N4442700',
'N2481200',
'B1044820',
'D1131220',
'A1196910',
'DJ112000',
'B1089300',
'N2136200',
'D2186510',
'D1070820',
'N3665500',
'T1523110',
'B1076310',
'A1116610',
'B1521910',
'B1074510',
'B1230800',
'N5373900',
'N3231100',
'B2298500',
'D3390600',
'N3103300',
'D1150420',
'N2459100',
'D1190920',
'N2122000',
'B1796000',
'A1118910',
'D1220110',
'N3721800',
'B1041620',
'B2329600',
'B1443300',
'B1029510',
'B1074600',
'A1183810',
'N4595900',
'A1114710',
'N4184600',
'N1228200',
'D3083000',
'B1094510',
'B1150400',
'N3753700',
'A1019010',
'N1538200',
'B1135210',
'N5100300',
'N3463100',
'B1052210',
'A1214510',
'B1098510',
'B1105710'
)";
$insertdata = 0;
$dvrhis_query = mysqli_query($con,$sitesql); 
if(mysqli_num_rows($dvrhis_query)){ 
		while($sql_result = mysqli_fetch_assoc($dvrhis_query)){ 
		 
				$Customer = $sql_result['Customer'];$Bank = $sql_result['Bank'];$SiteAddress=$sql_result['SiteAddress']	;
				$ATMID = $sql_result['ATMID'];$City = $sql_result['City'];$State=$sql_result['State'];$Zone = $sql_result['Zone'];
				$NewPanelID=$sql_result['NewPanelID']	;
				$live = $sql_result['live'];$Password = $sql_result['Password'];$UserName=$sql_result['UserName'];$DVRName = $sql_result['DVRName'];
				$DVRIP=$sql_result['DVRIP'];$PanelsIP = $sql_result['PanelIP'];$SN = $sql_result['SN'];	
				$AlertType = $sql_result['AlertType'];$live_date = $sql_result['live_date'];
				
                $ai_site_sql = mysqli_query($con,"select id from ai_sites where SN='".$SN."'");  
				if(mysqli_num_rows($ai_site_sql)==0){ 
						$insert_sql="insert into ai_sites(Project,Customer,Bank,ATMID,Location,SiteAddress,City,State,Zone,NewPanelID,DVRIP,DVRName,UserName,Password,live,rtsp_stream,pie_username,pie_pwd,PanelIP,AlertType,SN)
					   values('','".$Customer."','".$Bank."','".$ATMID."','".$SiteAddress."','".$SiteAddress."','".$City."','".$State."','".$Zone."','".$NewPanelID."','".$DVRIP."','".$DVRName."','".$UserName."','".$Password."','".$live."','','','','".$PanelsIP."','".$AlertType."','".$SN."')";
					  // echo $insert_sql;die;
					   $result=mysqli_query($con,$insert_sql) ;  
					   if($result==1){
						   $insertdata = $insertdata + 1;
					   }
				}
		}
}
echo $insertdata;
CloseCon($con);
?>