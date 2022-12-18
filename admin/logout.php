<?php session_start(); ?>
<?php 

include_once 'includes/header.php'; 
require_once './../functions.php';
?>


<?php include_once 'includes/unauthgate.php'; ?>

<?php 

unset($_SESSION['admin_auth_id']);
session_destroy();

$_SESSION['success'] = "You successfully logged out";
redirect(base_url('admin/login.php'))
?>