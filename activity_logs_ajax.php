<?php session_start();include('db_connection.php'); $con = OpenCon();
date_default_timezone_set('Asia/Kolkata');

//$month = $_GET['month'];
//$year = $_GET['year'];
/*
    $usersql = mysqli_query($con,"select cust_id,bank_id from loginusers where id='".$userid."'");
	$userdata = mysqli_fetch_assoc($usersql);
	$_bank_ids = $userdata['bank_id'];
    $banks = explode(",",$_bank_ids);
	$_bank_name = []; $_bank_name_array = [];
	for($i=0;$i<count($banks);$i++){
		$_bank = explode("_",$banks[$i]);
		if($_bank[0]==$client){
		   array_push($_bank_name,$_bank[1]);
		   array_push($_bank_name_array,$_bank[1]);
		}
	} 
	   
    $_bank_name=json_encode($_bank_name);
	$_bank_name=str_replace( array('[',']','"') , ''  , $_bank_name);
	$bankarr=explode(',',$_bank_name);
	$_bank_name = "'" . implode ( "', '", $bankarr )."'"; */

function createDateRangeArray($strDateFrom,$strDateTo)
{
    // takes two dates formatted as YYYY-MM-DD and creates an
    // inclusive array of the dates between the from and to dates.

    // could test validity of dates here but I'm already doing
    // that in the main script

    $aryRange = [];

    $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
    $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

    if ($iDateTo >= $iDateFrom) {
        array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
        while ($iDateFrom<$iDateTo) {
            $iDateFrom += 86400; // add 24 hours
            array_push($aryRange, date('Y-m-d', $iDateFrom));
        }
    }
    return $aryRange;
}

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];
	//	$start_date = '2024-12-23';
	//	$end_date = '2025-01-13';

		$_dt_range = createDateRangeArray($start_date,$end_date);
		
	//	echo '<pre>';print_r($_dt_range);echo '</pre>';die;

		$today = date('Y-m-d');
		$today_split = explode("-",$today);
		$this_year = $today_split[0];
		$this_month = $today_split[1];
		$created_at = date('Y-m-d H:i:s');

		$split_created_at = explode(' ',$created_at);
		$split_time = explode(":", $split_created_at[1]);
		$nowtime_hour = $split_time[0];

		$current_mon = date('m');

?>
        <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead >
                        <tr>
						    <th>SNo.</th><th>Name</th><th>User Name</th><th>User ID</th>
							<th>Activity Description</th><th>Activity Time</th><th>Last Login</th>			
                        </tr>
                      </thead>
                      <tbody>
					    <?php 
						
							$count = 0;
							for($i=0;$i<count($_dt_range);$i++){	
								$live_dt = $_dt_range[$i];
								//$_date_check = str_replace("-","_",$live_dt);
								$_date_check = $live_dt;
								// newnetwork_report_new_26082024  newnetwork_report_new
								$net_qry_sql = "SELECT user_activity_logs.activity_description,user_activity_logs.created_at,loginusers.name,loginusers.uname,loginusers.id,loginusers.bank_id,(SELECT created_at FROM user_activity_logs WHERE activity_description='login' AND user_id=loginusers.id AND site_url='Hitachi' ORDER BY id DESC LIMIT 1) AS last_login FROM `user_activity_logs` INNER JOIN loginusers ON user_activity_logs.user_id = loginusers.id WHERE user_activity_logs.site_url='Hitachi' AND CAST(user_activity_logs.created_at AS DATE)='".$_date_check."'";
								$net_sql_res = mysqli_query($con,$net_qry_sql);
								$total_24Hrs_Done = 0; $total_24Hrs_NotDone = 0;
								$total_net_his = mysqli_num_rows($net_sql_res);
								$total_Rejected_Done = 0; $total_Rejected_NotDone = 0;
								$total_Dispute_Done = 0; $total_Dispute_NotDone = 0;
								if($total_net_his>0){
									while($net_his_sql_result = mysqli_fetch_assoc($net_sql_res)){
										$activity_description = $net_his_sql_result['activity_description'];
										$created_at = $net_his_sql_result['created_at'];
										$name = $net_his_sql_result['name'];
										$uname = $net_his_sql_result['uname'];
										$uid = $net_his_sql_result['id'];
									    $_user_lastlogin = $net_his_sql_result['last_login'];
									
									$count++;
									
									?>
									   <tr>
									       <td><?php echo $count;?></td>
										   <td><?php echo $name;?></td>
										   <td><?php echo $uname;?></td>
										   <td><?php echo $uid;?></td>
										   <td><?php echo $activity_description;?></td>
										   <td><?php echo $created_at;?></td>
						                   <td><?php echo $_user_lastlogin;?></td>
										</tr>
								
								<?php  
								      }
								}
								   }
								
								  CloseCon($con);
								?>
                      </tbody>
                    </table>
                  </div>

