<?php
//Contact table
function contact_table($con)
{
    mysqli_query($con, "CREATE TABLE `contact_responses` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `name` VARCHAR(50) NOT NULL , 
    `email` VARCHAR(30) NOT NULL , 
    `ph_number` VARCHAR(15) NOT NULL , 
    `msg` TEXT NOT NULL , 
    `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
    PRIMARY KEY (`id`)) ENGINE = InnoDB;"
    );
    mysqli_query($con, "COMMIT;");
}
