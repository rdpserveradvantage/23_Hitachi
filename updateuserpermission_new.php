<?php
include 'db_connection.php';
$con = OpenCon();
$loginusers_sql = "select * from loginusers";
$loginusers_list = mysqli_query($con, $loginusers_sql);
if (mysqli_num_rows($loginusers_list) > 0) {
    while ($userlist = mysqli_fetch_assoc($loginusers_list)) {
        $permission = $userlist['permission'];
        $id = $userlist['id'];
        // echo "previous : ".$permission . "\n"; echo '</br>';
        $permission_arr = explode(',', $permission);
        if (!in_array('44', $permission_arr)) {
            $newpermission = $permission . ',44';
            //  $update_qry = "update loginusers SET permission = '" . $newpermission . "' where id='" . $id . "'";
            //  $is_update = mysqli_query($con, $update_qry);
            //  $is_update;die;
        } else {
            // echo "after trim : ". trim($permission, ",37");
            if (($key = array_search('44', $permission_arr)) !== false) {
                unset($permission_arr[$key]);
                $str_per = implode(',', $permission_arr);
                $update_qry = "update loginusers SET permission = '" . $str_per . "' where id='" . $id . "'";
                $is_update = mysqli_query($con, $update_qry);

            }

        }

    }
}
