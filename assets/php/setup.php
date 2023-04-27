<?php
// Connection to MySQL server without database name.
include("conn.php");
include("create_tables.php");

// Set the desired charset after establishing a connection
$con->set_charset('utf8mb4');


// FOR DATABASE
$databaseName = $DATABASE_NAME;
$command = "SHOW DATABASES LIKE '{$databaseName}';";
$command2 = "CREATE DATABASE IF NOT EXISTS `{$databaseName}`;";

// Create database if not exists.
// echo $command;
$query = mysqli_query($con, $command);
$result = mysqli_num_rows($query);

if($result <=0){
$create = mysqli_query($con, $command2);
// echo "Database created successfully";
}

// USE DATABASE
mysqli_select_db($con, $databaseName);


//Contact table
contact_table($con);
registration_table($con);

// mysqli_query($con, "CREATE TABLE IF NOT EXISTS `food_items` (
//     `id` int(11) NOT NULL AUTO_INCREMENT,
//     `name` varchar(50) NOT NULL,
//     `type` varchar(10) NOT NULL DEFAULT 'VEG',
//     `desc` text NOT NULL,
//     `image` text NOT NULL,
//     `price` DOUBLE NOT NULL,
//     `status` varchar(15) NOT NULL DEFAULT 'AVAILABLE',
//     PRIMARY KEY (`id`)
//   ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
//   ");


//commit
mysqli_query($con, "COMMIT;");
header('Location: /');
