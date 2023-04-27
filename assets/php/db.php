<?php
include("conn.php");


// Set the desired charset after establishing a connection
$con->set_charset('utf8mb4');


// USE DATABASE
try {
    mysqli_select_db($con, $DATABASE_NAME);
} catch (\Throwable $th) {
    header('Location: /assets/php/setup.php');
}


//commit
mysqli_query($con, "COMMIT;");
