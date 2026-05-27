<?php 
    include('db_connection.php'); 
	$con = OpenCon(); 
	date_default_timezone_set('Asia/Kolkata');
	$user_id = $_POST['user_id'];
	$created_at = date('Y-m-d H:i:s');
	$six_digit_random_number = mt_rand(100000, 999999);
	$insert_sql="insert into login_user_otp(user_id,user_otp,created_at) values('".$user_id."','".$six_digit_random_number."','".$created_at."')";
	$insertresult=mysqli_query($con,$insert_sql) ; 
	  
   //===========for mail===============

    $EmailSubject="Thank you for your Login ";
    $MESSAGE_BODY="";
    $email = "prabir.d06@gmail.com";
    $MESSAGE_BODY.="your otp is: ".$six_digit_random_number."\r\n";
   
    $message="Dear You have been successfully registered please login with following link"."\r\n";
           
    $leadsmail="rms@comforttechno.com";
    $mailheader = "From: ".$leadsmail."\r\n"; 
    $mailheader .= "Reply-To: ".$leadsmail."\r\n"; 
 

require 'phpmail/src/PHPMailer.php';
require 'phpmail/src/SMTP.php';
require 'phpmail/src/Exception.php';


$msg = "";

$mail = new PHPMailer\PHPMailer\PHPMailer();
try{
    //Server settings
    //$mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
     $mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'rms@comforttechno.com';                 // SMTP username
    $mail->Password = 'Css@ctrm123';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('rms@comforttechno.com','comforttechno');
    $mail->addAddress($email); 
    $mail->mailheader=$mailheader;// Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('ramshankargupta444@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //Content
    $mail->isHTML(false);                                  // Set email format to HTML
    $mail->Subject = $EmailSubject."\r\n";
    $mail->Body    = $message."\r\n".$MESSAGE_BODY;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    //$mail->AltBody=$MESSAGE_BODY;
    $mail->send();
	$data=['Code'=> 200,'msg'=>'Mail Sent Successfully','otp'=>$six_digit_random_number];
}
catch(Exception $e){

    $msg = "Mail not send due to SMTP Host error!!!";
    $data=['Code'=> 201,'msg'=>$msg];
}

CloseCon($con);
echo json_encode($data); 

?>