<?php include_once 'includes/header.php'; ?>

<?php
session_start();

//Require Files and Functions
require_once '../functions.php';
require_once '../database.php';


// Initialize Error
$errors= [];

// Cast inputs to variable
$inputs = $_POST;

if(isset($_POST['update'])){
    // Get all Input
    $old_password = clean_input($inputs['old_password']);

    $password = clean_input($inputs['password']);
    
    $confirm_password = clean_input($inputs['confirm_password']);

    // Old password checks
    if(!empty($old_password)){
        $id= $_SESSION['admin_auth_id'];
        $sql= "SELECT * FROM admin WHERE id='$id'";
        $query= $mysql->query($sql);
        $records = $query->fetch_assoc();
        if(!password_verify($old_password,$records['password'])){
            $errors['old_password'] = "Enter a valid old password";
        }
    }else {
        $errors['old_password'] = "Enter your old password";
    }

    // New password checks
    if(!empty($password)){
       if(strlen($password) < 8){
            $errors['password'] = "Enter a password of min. 8 characters";
       }
    }else {
        $errors['password'] = "Enter your new password";
    }

    // Confirm password checks
    if(!empty($confirm_password)){
        if($confirm_password !== $password){
             $errors['confirm_password'] = "Confirm password do not match";
        }
     }else {
         $errors['confirm_password'] = "Re-enter your password";
     }


    if(!empty($errors)){
        // Storing Input and Errors into sessions
        $_SESSION['errors'] = $errors; 

        redirect(base_url('admin/settings.php'));
    }else{
        $id= $_SESSION['admin_auth_id'];
        $hashed = password_hash($password,PASSWORD_DEFAULT);
        $sql = "UPDATE admin SET password='$hashed' WHERE id='$id'";
        $query = $mysql->query($sql);
        if($query){
            $_SESSION['success'] = "Your password is successfully changed"; 

            redirect(base_url('admin/settings.php'));
        }
    }

    
   


}

?>