<?php include_once 'includes/header.php'; ?>

<?php
session_start();

//Require Files and Functions
require_once __DIR__.'/functions.php';
require_once __DIR__.'/database.php';


// Initialize Error
$errors= [];

// Cast inputs to variable
$inputs = $_POST;

// Room types
$room_types = ['Single Room', 'Self-contained', 'Flat', 'Hostel'];

// Roomate Number 
$mate_number = ['none','1','2'];

// Levels
$level_types = ['none', '100','200','300','400','500','600'];

// Institutions
$institution_types = ['none',  'OAU','OUI'];


if(isset($_POST['request'])){
    // Get all Input
    $name = clean_input($inputs['name']);

    $email = clean_input($inputs['email']);

    $phonenumber = clean_input($inputs['phone_number']);

    $hosteltype = clean_input($inputs['type']);

    $roommate = clean_input($inputs['roomate']);

    $budget = clean_input($inputs['budget']);

    $location = clean_input($inputs['location']);

    $level = clean_input($inputs['level']);

    $institution = clean_input($inputs['institution']);
    
    // Checks for name
    if(!empty($name)){
        $name = filter_var($name, FILTER_SANITIZE_STRING);
    }else {
        $errors['name'] = "Enter your name";
    }

    // Checks for email
    if(!empty($email)){
        // $email = filter_var($name, FILTER_SANITIZE_EMAIL);
        // echo $email;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Enter a valid email";
        }
    }else {
        $errors['email'] = "Enter your email";
    }

    // Checks for phone Number 
    if(!empty($phonenumber)){
        if(strlen($phonenumber) >= 11){
            if(!is_numeric($phonenumber)){
                $errors['phone'] = "Enter a valid phone number";
            }
        }else {
            $errors['phone'] = "Enter a valid phone number";
        }
    }else {
        $errors['phone'] = "Enter your phone number";
    }

    // Checks for Hostel types
    if(!empty($hosteltype)){
        if(!in_array($hosteltype, $room_types)){    
            $errors['type'] = "Choose a valid hostel types";
        }
    }else {
        $errors['type'] = "Choose a hostel type";
    }

    // Checks for Roomates
    if(!empty($roommate)){
        if(!in_array($roommate, $mate_number)){    
            $errors['roomate'] = "Choose a valid roomate number";
        }
    }else {
        $errors['roomate'] = "Choose roomate number";
    }

    // Checks for Institution
    if(!empty($institution)){
        if(!in_array($institution, $institution_types)){    
            $errors['institution'] = "Choose a valid institution";
        }
    }else {
        $errors['institution'] = "Choose an institution";
    }

    // Checks for Level
    if(!empty($level)){
        if(!in_array($level, $level_types)){    
            $errors['level'] = "Choose a valid level";
        }
    }else {
        $errors['level'] = "Choose a level";
    }

    // Checks for budget
    if(!empty($budget)){
        if(!is_numeric($budget)) {
            $errors['budget'] = "Enter a valid budget";
        }
    }else {
        $errors['budget'] = "Enter your budget";
    }

    if(!empty($errors)){
        // Storing Input and Errors into sessions
        $_SESSION['errors'] = $errors; 
        $_SESSION['inputs'] = $inputs;

        redirect(base_url());
    }else{
        $today_date = date("Y-m-d");
        $checkSql = "SELECT * FROM `requests` WHERE (email='$email' AND DATE(datetime)='$today_date') OR (phone='$phonenumber' AND DATE(datetime)='$today_date')";
        $checkQuery = $mysql->query($checkSql);
        $checkCount = $checkQuery->num_rows;
        if($checkCount < 2){

            $sql= "INSERT INTO requests (name,email,phone,type,roomate,location,budget,institution,level) VALUES ('$name','$email','$phonenumber','$hosteltype','$roommate','$location','$budget','$institution','$level')";
            $query= $mysql->query($sql);
            if($query){
                $mailContent = file_get_contents('./mail/request.php');
                $body = str_replace("{{ name }}", $name,$mailContent);


                $data = [
                    'subject' => "Your request was received",
                    'name' => $name,
                    'email' => $email,
                    'body' => $body
                ];

                if(sendMail($data) == "Ok"){
                    $_SESSION['success'] = "Your request was successfully submited";
                    redirect(base_url());
                }else{
                    $_SESSION['error'] = "Ooops, An error has occured";
                    redirect(base_url());
                }
                
            }else {
                $_SESSION['error'] = "An errror just occured";
                redirect(base_url());
            }
        }else{
            $_SESSION['error'] = "You can only make two accomomodation requests per day";
            redirect(base_url());
        }
       
    }


}

?>