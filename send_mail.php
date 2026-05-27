<?php 
$six_digit_random_number = mt_rand(100000, 999999);

$to       = 'prabir.d06@gmail.com';
$subject  = 'My test email';
$message  = 'Hi, my message!';
$headers  = 'From: rms@comforttechno.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=utf-8';
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";

?>