<?php
session_start();
if(isset($_SESSION['login_user']) && isset($_SESSION['id']))
{
    
include 'config.php';
error_reporting(0);

$Atmid=$_POST['Atmid'];

$strPage=$_POST['Page'];
$per_Page=$_POST['perpg'];
function endsWith($haystack, $needle)
{
    $length = strlen($needle);

    return $length === 0 || 
    (substr($haystack, -$length) === $needle);
}

            if($from!="")
            {
            $fromdt = date("Y-m-d", strtotime($from));
            }
            else
            {
                $fromdt="";
            }
                if($to!="")
                {
                $todt = date("Y-m-d", strtotime($to));
                }else
                {
                   $todt=""; 
                }

 $sr=1;

$abc_count="select count(*) from dvr_health where  live='y'";
$abc="select * from dvr_health where  live='y'";


if($_SESSION['permission']!="" && $_SESSION['designation']=="2"){
    
    $Id=$_SESSION['permission'];
    $perm=array();
    
    $IDsplit=explode(',',$Id);
    
    
    foreach($IDsplit as  $element){
        $perm[]=$element;
    }
    $per= "'".implode("','",$perm)."'";
    
   $abc_count.=" and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
   $abc.=" and atmid IN (select ATMID from sites where CTS_LocalBranch IN($per) and live='Y')";
}

if($_SESSION['designation']=="4"){
   $abc_count.=" and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
   $abc.=" and atmid IN (select ATMID from sites where Customer='Hitachi' and live='Y')";
}

    $result=mysqli_query($conn,$abc_count);
    
     $Num_Rows=mysqli_fetch_row($result)[0];
  
    //$Per_Page =$_POST['perpg'];   // Records Per Page
$Per_Page =$Num_Rows;
$Page = $strPage;

if($strPage=="")
{
	$Page=1;
}
 
$Prev_Page = $Page-1;
$Next_Page = $Page+1;


$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
if($Per_Page!="all")
$abc.=" LIMIT $Page_Start , $Per_Page";
	
$qrys=mysqli_query($conn,$abc);

	$count=mysqli_num_rows($qrys);

$sr=1;
	if($Page=="1" or $Page=="")
	{
	$sr="1";
	}else
	{
	   $sr=($Per_Page* ($Page-1))+1;
	   
	}

?>


</center>

 <table id="datatable-buttons"  class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
 <thead>
    <tr >
        <td>SN</td>
        <td ><div >ATM-ID</div></td>
        
        <td ><div id="">Last Communication</div></td>
        <td ><div id="">Latest Date_Time &nbsp; </div></td>
        <td ><div id="">Down Since</div></td>
        <td><div id="">IP Address</div></td>
        <td><div id="">NetworkStatus</div></td>
        <td><div id="">DVR Type</div></td>
        <td><div id="">DVRLogin</div></td>
        <td><div id="">Camera1</div></td>
        <td><div id="">Camera2</div></td>
        <td><div id="">Camera3</div></td>
        <td><div id="">Camera4</div></td>
        <td><div id="">HDD_status</div></td>
        <td><div id="">Recording_from</div></td>
        <td><div id="">HDD_capacity</div></td>
        <td><div id="">HDD_freespace</div></td>
        <td><div id="">Latency</div></td>
        <!--<td><div  id="">DVR Not Login</div></td>-->
        <td ><div >Bank</div></td>
        <td ><div >Customer</div></td>
        <td ><div >Zone</div></td>
        <td ><div >BM</div></td>
        <td ><div >City</div></td>
        <td ><div >State</div></td>
        <td><div  id="">site Address</div></td>
    </tr>
 </thead>

       <tbody>
                 
  <?php  while($row = mysqli_fetch_array($qrys)) { 

$StateQry= mysqli_query($conn,"select State,PanelIP,City,SiteAddress,Bank,Customer,Zone from sites where ATMID='".$row['atmid']."'");
$fetchState=mysqli_fetch_array($StateQry);

$numQry= mysqli_query($conn,"select id from dvr_health where status='1' and login_status='1' and id='".$row['id']."' ");
$num=mysqli_num_rows($numQry);

$BMnameQry= mysqli_query($conn,"select CSSBM from esurvsites where ATM_ID='".$row['atmid']."' ");
$fetchBM=mysqli_fetch_array($BMnameQry);

if($row[11]!="0000-00-00 00:00:00"){
    $currdat=date("Y-m-d");
$date1=date_create($currdat);
$date2=date_create($row[11]);
$diff=date_diff($date1,$date2);
$datedif_cnt=$diff->format("%a days");

}else{$datedif_cnt="NA";}
?>
  <tr <?php if($row[2]==0 || $row[10]==1){ ?>style="background-color:#FF0000" <?php } ?> >
       <td><?php echo $sr;?></td>
       <td><?php echo $row[12];?></td>
        
       <td ><?php echo $row[9];?></td>
       <td align="center"><div id=""><?php echo $row[11]; ?></div></td>
       <td align="center"><div id=""><?php echo $datedif_cnt ; ?></div></td>
       <td align="center"><div id=""><?php echo $row[1]; ?></div></td>
       <td align="center"><div id=""><?php if($row[2]==1)echo 'good'; else echo 'bad'; ?></div></td>
       <td align="center"><div id=""><?php echo $row[17]; ?></div></td>
       <td align="center"><div id=""><?php if($row[2]==1 && $row[10]==0)echo 'yes'; else echo 'No'; ?></div></td>
       <td align="center"><div id=""><?php echo $row[3]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[4]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[5]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[6]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[7]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[15]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[13]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[14]; ?></div></td>
       <td align="center"><div id=""><?php echo $row[8]; ?></div></td>
      <!-- <td align="center"><div id=""><?php if($num>0){ echo "Not Working"; }  ?></div></td>-->
       <td><?php echo $fetchState['Bank'];?></td>
       <td><?php echo $fetchState['Customer'];?></td>
        <td><?php echo $fetchState['Zone'];?></td>
        <td><?php echo $fetchBM['CSSBM'];?></td>
       <td ><?php echo $fetchState['City'];?></td>
       <td ><?php echo $fetchState['State'];?></td>
       
       <td ><?php echo $fetchState['SiteAddress'];?></td> 
    </tr>
   <?php
$sr++;
 
}
?>
  </tbody>
</table>

 </form>
 
 
       

 
<center>

</center>
	</div >

</body>
</html>


<?php
}else
{ 
 header("location: index.php");
}
?>






