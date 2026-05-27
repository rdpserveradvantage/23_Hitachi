<?php
/*
$host="172.55.27.254";

exec("ping -c 4 " . $host, $output, $result);

print_r($output);

if ($result == 0)

echo "Ping successful!";

else

echo "Ping unsuccessful!";


echo exec('ping -n 1 -w 1 172.55.19.34');

*/
//$ip = "172.55.25.89";
//$ip = "172.55.23.126";
$ip = "172.55.27.254";
exec("ping -n 4 $ip", $output, $status);
print_r($output);
?>