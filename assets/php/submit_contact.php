<?php
include("db.php");
include("create_tables.php");

$name = $_POST['name'];
$email = $_POST['email'];
$ph_no = $_POST['ph_number'];
$msg = $_POST['message'];

$res = array();

if ($name === "" or $name === " ") {
    $res['type'] = 'error';
    $res['code'] = 'Name';
    $res['desc'] = 'blank';
} elseif ($email === "" or $email === " ") {
    $res['type'] = 'error';
    $res['code'] = 'E-mail';
    $res['desc'] = 'blank';
} elseif ($ph_no === "" or $ph_no === " " or strlen($ph_no)<10) {
    $res['type'] = 'error';
    $res['code'] = 'Phone Number';
    $res['desc'] = 'blank';
} elseif ($msg === "" or $msg === " ") {
    $res['type'] = 'error';
    $res['code'] = 'Message';
    $res['desc'] = 'blank';
} else {

    $query = "INSERT INTO `contact_responses` (`name`, `email`, `ph_number`, `msg`) VALUES ('$name', '$email', '$ph_no', '$msg')";

    try {
        // Your code that may throw an exception
        // mysqli_query($con,$query);
        $con->query($query);
    } catch (mysqli_sql_exception $e) {
        // Handle the exception
        contact_table(($con));
        $con->query($query);
    }

    $res['type'] = 'res';
    $res['code'] = 'success';
    $res['desc'] = 'success';

    //sending order mail
    function send_order($to_mail, $to_name, $order_id, $cart_json, $cut, $total_cost, $mobile, $room, $del_loc)
    {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'techverse.mescoe@gmail.com';                     //SMTP username
        $mail->Password   = 'znykpkkahixwlzze';                               //SMTP password
        $mail->SMTPSecure = 'ssl';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('techverse.mescoe@gmail.com', 'TechVerse');
        $mail->addAddress($to_mail, $to_name);     //Add a recipient
        $mail->addBCC('techverse.mescoe@gmail.com', 'Admin');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "TechVerse Event Registration Confirmation>";
        $mailBody = "
            
            ";
        // $mail->Body    = $mailBody;

        // $mail->AltBody = $mailBody;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    }   

}

echo json_encode($res);
