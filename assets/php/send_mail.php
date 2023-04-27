<?php
include('../php/db.php');

// include("vendor/autoload.php")
require 'vendor/autoload.php';
// require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$email_ending = "@vitstudent.ac.in";
// echo json_encode($_POST);
$emailid = $_POST['emailid'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$mobileno = $_POST['mobileno'];
$hostelblock = $_POST['hostelblock'];
$roomnumber = $_POST['roomnumber'];
$deliveryloc = $_POST['deliveryloc'];

$responce = array();
$_SESSION['otp'] = rand(100000, 999999);

// $responce['otp'] = $_SESSION['otp'];

if (substr($emailid, strlen($emailid) - strlen($email_ending)) === $email_ending) {
    $responce['email_verification'] = "success";
} else {
    $responce['email_verification'] = "invalid";
}
$responce['email_verification'] = "success";

function send_otp($email, $name, $otp)
{
    // return true;
    // $_SESSION['otp'];
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'baamfoods@gmail.com';                     //SMTP username
        $mail->Password   = 'znykpkkahixwlzze';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('baamfoods@gmail.com', 'Baam Foods');
        $mail->addAddress($email, $name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'BaamFoods - OTP to confirm your Order';
        $mail->Body    = "Please use <b style='color:green;'>{$otp}</b> as <b>OTP</b> to confirm your Order.<br>Thank You for using our Service<br><br><i>(Never share your OTP with anyone)</i>";
        $mail->AltBody    = "Please use <b style='color:green;'>{$otp}</b> as <b>OTP</b> to confirm your Order.<br>Thank You for using our Service<br><br><i>(Never share your OTP with anyone)</i>";
       
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


if ($responce['email_verification'] == "success") {
    if (send_otp($emailid, $firstName, $_SESSION['otp'])) {
        $responce['otp_send'] = "success";
    } else {
        $responce['otp_send'] = "fail";
    }
} else {
    $responce['otp_send'] = "fail";
}

echo json_encode($responce);
