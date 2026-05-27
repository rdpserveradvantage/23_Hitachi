<?php 


function get_total_sites_count(){
    global $conn; 
    
    $sql = mysqli_query($conn,"select count(SN) as total from sites where live ='Y'");
    $sql_result = mysqli_fetch_assoc($sql);
    
    return $sql_result['total'];
}



function get_minutes($last_update_time, $current_datetime){
    $start_date = new DateTime($last_update_time);
    $since_start = $start_date->diff(new DateTime($current_datetime));
    $minutes = $since_start->days * 24 * 60;
    $minutes += $since_start->h * 60;
    $minutes += $since_start->i;
    
    return $minutes; 
}

?>