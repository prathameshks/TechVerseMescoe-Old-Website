<?php
include('../php/db.php');

// include("vendor/autoload.php")
require '../../vendor/autoload.php';
// require_once "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


function send_mail($name, $email, $subject, $date, $time, $venue,$event)
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
        $mail->Username   = 'techverse.mescoe@gmail.com';                     //SMTP username
        $mail->Password   = 'exqxndxbmqahubrp';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('techverse.mescoe@gmail.com', 'Events Management(TechVerse)');
        $mail->addAddress($email, $name);     //Add a recipient

        $template = file_get_contents('../mail-t/index.html');

        // Replace placeholders in the template with your data
        $template = str_replace('%USER_NAME%', $name, $template);
        $template = str_replace('%USER_MAIL%', $email, $template);
        $template = str_replace('%EVENT_DATE%', $date, $template);
        $template = str_replace('%EVENT_TIME%', $time, $template);
        $template = str_replace('%EVENT_VENUE%', $venue, $template);
        $template = str_replace('%EVENT_NAME%', $event, $template);

        $invite_file = "../mail-t/TechVerse Invite.ics";

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $template;
        $mail->AltBody    = $template;
        $mail->addAttachment($invite_file,"Techverse-Invite.ics");


        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    } catch (Exception $e) {
        // echo $e;
        return false;
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



// $res = send_mail('Prathamesh Sable','prathameshks2003@gmail.com', "This IS Subject","2nd May,2023","12:30 PM","Room No. 514, MESCOE, Pune","TechVerse's Induction Program");
// echo $res;

// echo json_encode($responce);
