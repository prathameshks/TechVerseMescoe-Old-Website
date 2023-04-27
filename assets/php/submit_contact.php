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

    
}

echo json_encode($res);
