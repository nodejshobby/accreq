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

if(isset($_POST['login'])){
    // Get all Input
    $email = clean_input($inputs['email']);

    $password = clean_input($inputs['password']);

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

    if(empty($password)){
        $errors['password'] = "Enter your password ";
    }

    if(!empty($errors)){
        // Storing Input and Errors into sessions
        $_SESSION['errors'] = $errors; 
        $_SESSION['inputs'] = $inputs;

        redirect(base_url('admin/login.php'));
    }else{
        $sql= "SELECT * FROM admin WHERE email='$email'";
        $query= $mysql->query($sql);
        $records = $query->fetch_assoc();
        $record_count = $query->num_rows;
        if($record_count > 0){
            if(password_verify($password,$records['password'])){
                $_SESSION['admin_auth_id'] = $records['id'];
                redirect(base_url('admin/index.php'));
            }else{
                $_SESSION['inputs'] = $inputs;
                $_SESSION['error'] = "Invalid email or password";
                redirect(base_url('admin/login.php'));
            }
        }else {
            $_SESSION['inputs'] = $inputs;
            $_SESSION['error'] = "Invalid email or password";
            redirect(base_url('admin/login.php'));
        }
    }


}

?>