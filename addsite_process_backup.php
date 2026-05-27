<?php
/*
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
	*/
include 'config.php';?>
<html>
    <head>
        
        
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.10.2/sweetalert2.all.min.js"></script>
        
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        
  -->
<body>
<?php
$newname="";
$Status=$_POST['Status'];
$Phase=$_POST['Phase'];
$Customer=$_POST['Customer'];
$Bank=$_POST['Bank'];
$ATMID=$_POST['ATMID'];
/*$ATMID_2=$_POST['ATMID_2'];
$ATMID_3=$_POST['ATMID_3'];
$ATMID_4=$_POST['ATMID_4'];
$TrackerNo=$_POST['TrackerNo'];*/
$ATMShortName=$_POST['ATMShortName'];
$SiteAddress=$_POST['SiteAddress'];
 $City=$_POST['City'];
$GSM=$_POST['GSM'];
 $State=$_POST['State'];
$Zone=$_POST['Zone'];
$Panel_Make=$_POST['Panel_Make'];
$OldPanelID=$_POST['OldPanelID'];
$NewPanelID=$_POST['NewPanelID'];
$DVRIP=$_POST['DVRIP'];
$PanelsIP=$_POST['PanelsIP'];
// $DVRName=$_POST['DVRName'];
$DVR_Model_num=$_POST['DVR_Model_num'];
$Router_Model_num=$_POST['Router_Model_num'];

$UserName=$_POST['UserName'];
$Password=$_POST['Password'];
$engname=$_POST['engname'];
date_default_timezone_set('Asia/Kolkata');
$curentdt=date("Y-m-d H:i:s");
$t=date("H:i:s");

$instdt=$_POST['dates'];
if($instdt==""){
 $instdt=date("Y-m-d");   
}
$remark=$_POST['Remark'];

// $abc="select state from state where state_id='".$State."'";
// $runabc=mysqli_query($con,$abc);
// $fetch=mysqli_fetch_array($runabc);

$live=$_POST['live'];
/*
$live=$_POST['live'];
$name=$_FILES['up']['name'];
$size=$_FILES['up']['size'];
$type=$_FILES['up']['type'];
$tmp_name=$_FILES['up']['tmp_name'];
$location="ram/".time().$name;

//$location="ram/";
$imgdir = $location;
    
move_uploaded_file($tmp_name,$location);
*/
$image_name='';
$maxsize='2140';
//$_FILES['email_cpy']['name'];
$size=($_FILES['email_cpy']['size']/1024);

if($_FILES['email_cpy']['name']!=''){
//echo $size." *** ".$maxsize;
if($size>$maxsize)
{

echo "Your file size is ".$size."File is too large to be uploaded. You can only upload ".$maxsize." KB of data. Please go back and try again";
$error++;
}
else
{

 define ("MAX_SIZE","100"); 
 
$fichier=$_FILES['email_cpy']['name']; 

//echo $fichier;
 function getExtension1($str)
 {
	$i = strrpos($str,".");
	if (!$i) { return ""; }
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
 }
	
	//echo $fichier;
if($fichier){
//echo "hi" ;
$filename = stripslashes($_FILES['email_cpy']['name']);
//echo $filename;
			//get the extension of the file in a lower case format
				$extension = getExtension1($filename);
				$extension = strtolower($extension);
				//echo $extension;
				$image_name=time().'.'.$extension;
				//echo $image_name;
$newname="newsiteimages/".$image_name;
	//echo $newname;	
	
$copied = copy($_FILES['email_cpy']['tmp_name'], $newname);


if (!$copied) 
{
	echo "<h1>Copy unsuccessfull!</h1>";
		$error++;                               
}
}

//echo $newname;

}


}
$username = 'Test';
//$username = $_SESSION['name'];
$sql="insert into sites(Status,Phase,Customer,Bank,ATMID,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP)
values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMShortName','$SiteAddress','$City','$State','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$UserName','$Password','$live','$curentdt','$instdt.$t','$engname','".$username."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP')";

//echo $sql;die;

//$sql="insert into sites(Status,Phase,Customer,Bank,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,City,State,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,DVRName,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,DVR_Serial_num,CTSLocalBranch,CTS_BM_Name,CTS_BM_Number,HDD,Camera1,Camera2,Camera3,Attachment1,Attachment2,liveDate,install_Status,Project_Id    )
//values('$Status','$Phase','$Customer','$Bank','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$City','".$fetch[0]."','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$DVRName','$UserName','$Password','$live','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP','','','','','','','','','','','$curentdt','','1')";


//$checkSite=mysqli_query($con,"select * from sites where DVRIP=");



 //$sql="insert into sites(Status,Phase,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,DVR_Model_num,Router_Model_num,PanelIP,partial_live )
 //values('$Status','$Phase','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress','$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$UserName','$Password','$live','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','$DVR_Model_num','$Router_Model_num','$PanelsIP','1')";
// echo $sql;

// $sql= "insert into sites(Status,Phase,ATMID,partial_live) values ('$Status','$Phase','$ATMID','1')";
	// echo $sql;die;
$result=mysqli_query($con,$sql);

//  var_dump($result);

 
$last=mysqli_insert_id($con);

if($last){
  /*  
    $sql2="insert into site_Attachment(site_id,mail_attachment) values('".$last."','".$newname."')";
    $result2=mysqli_query($con,$sql2);
	
	$sql3="insert into sites_log(Status,Phase,ATMID,ATMID_2,ATMID_3,ATMID_4,TrackerNo,ATMShortName,SiteAddress,Zone,Panel_Make,OldPanelID,NewPanelID,DVRIP,UserName,Password,live,current_dt,mailreceive_dt,eng_name,addedby,site_remark,site_id)
values('$Status','$Phase','$ATMID','$ATMID_2','$ATMID_3','$ATMID_4','$TrackerNo','$ATMShortName','$SiteAddress',$Zone','$Panel_Make','$OldPanelID','$NewPanelID','$DVRIP','$UserName','$Password','$live','$curentdt','$instdt.$t','$engname','".$_SESSION['name']."','$remark','".$last."')";
echo $sql3;
$result3=mysqli_query($con,$sql3);
 
$sql4="insert into esurvsites(ATM_ID,TwoWayNumber) values('".$ATMID."','".$GSM."')" ;
echo $sql4;
$runsql4=mysqli_query($con,$sql4); */
 //echo $sql4;
?>
<script>
alert("register successfully");
window.open("newsite.php", "_self");
        </script>
<script>

/*
swal({
  title: "Save Successfull!",
  text: "done!",
  icon: "success",
  button: "OK",
});
window.open("addsite.php","_self");
*/

</script> 

</body>
</html>

<?php
		}else{
			echo '<script>alert("Error");</script>';
			
		}

/*
}else
{ 
 header("location: index.php");
}
*/
?>

