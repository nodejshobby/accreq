<?php
require_once "vendor/autoload.php";
require_once "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// Get Base Url
function  base_url($path = null){
    if(is_null($path)){
        return BASE_URL;
    }
    return BASE_URL.'/'.$path;
}

// Clean Data Input
function clean_input($input){
    global $mysql;

    $data = stripslashes(trim($input));
    $data = $mysql->real_escape_string($data);
    return $data;
} 

//Redirect 
function redirect($url){
    header("Location: $url");
    exit;
}

// Get Inputs in session
function getInput($key){
    if(!empty($_SESSION['inputs']["$key"])){
        return $_SESSION['inputs']["$key"];
    }
    return '';
}

// Get Inputs in session
function getError($key){
    if(!empty($_SESSION['errors']["$key"])){
        return $_SESSION['errors']["$key"];
    }
    return '';
}

// Get Error Bag
function errorCount(){
    return count($_SESSION['errors']);
}

// Get all errors
function allError(){
    return $_SESSION['errors'];
}

// Unset all sessions content
function unsetAllBag(){
    $_SESSION['inputs'] = [];
    $_SESSION['errors'] = [];
    $_SESSION['success'] = '';
    $_SESSION['error'] = '';
    $_SESSION['info'] = '';
}

// Mail wrapper
function sendMail($data){
    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

    //Set PHPMailer to use SMTP.
    $mail->isSMTP();

    //Set SMTP host name                          
    $mail->Host = MAIL_HOST;

    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;     

    //Provide username and password     
    $mail->Username = MAIL_USER;                 
    $mail->Password = MAIL_PASSWORD;    

    //If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";    

    //Set TCP port to connect to
    $mail->Port = 587;  

    //From email address and name
    $mail->From = MAIL_SENDER;

    $mail->FromName = MAIL_USER;

    //To address and name
    $mail->addAddress($data["email"], $data['name']);

    //Address to which recipient will reply
    $mail->addReplyTo(MAIL_SENDER, MAIL_SENDER);

    //Send HTML or Plain Text email
    $mail->isHTML(true);

    $mail->Subject = $data['subject'];
    $mail->Body = $data["body"];

    try {
        $mail->send();
        return "Ok";
    } catch (Exception $e) {
        return "Error sending mail";
    }
}


// Get total requests
function getTotalRequest(){
    global $mysql;
    $sql = "SELECT * FROM requests";
    $query = $mysql->query($sql);
    $results = $query->num_rows;
    if($results > 0){
        return $results;
    }else{
        return '0';
    }
}

// Get today requests
function getTodayRequest(){
    global $mysql;
    $today_date = date("Y-m-d");
    $sql = "SELECT * FROM requests WHERE DATE(datetime)='$today_date'";
    $query = $mysql->query($sql);
    $results = $query->num_rows;
    if($results > 0){
        return $results;
    }else{
        return '0';
    }
}

// Get attended request
function getAttendedRequest(){
    global $mysql;
    $sql = "SELECT * FROM requests WHERE attended='true'";
    $query = $mysql->query($sql);
    $results = $query->num_rows;
    if($results > 0){
        return $results;
    }else{
        return '0';
    }
}

// Get Unattended request
function getUnattendedRequest(){
    global $mysql;
    $sql = "SELECT * FROM requests WHERE attended='false'";
    $query = $mysql->query($sql);
    $results = $query->num_rows;
    if($results > 0){
        return $results;
    }else{
        return '0';
    }
}


?>