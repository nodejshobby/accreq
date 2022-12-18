<?php

//Connecct to database
$mysql= new mysqli(DATABASE_HOST,DATABASE_USER,DATABASE_PASSWORD,DATABASE_NAME);

if($mysql->connect_errno){
    die("Error: A fatal error just occured");
}

?>
