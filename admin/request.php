<?php
session_start();

session_regenerate_id();

// Require Files and Functions
require_once '../functions.php';
require_once '../database.php';

?>
<?php include_once 'includes/header.php'; ?>

<?php 
    // Include Logo design file
    include_once 'includes/logo.php';
?>

<?php
    // Include Logo design file
    include_once 'includes/unauthgate.php';
?>

<div class="container">
    <div class="row">
        <div class="col-10 col-md-8 mx-auto bg-light p-2 rounded text-center admin-nav-box">
            <a href="<?php echo base_url('admin/index.php') ?>" class="me-3 text-decoration-none"><i class="fa fa-tachometer-alt"></i> Dashboard</a>
            <a href="<?php echo base_url('admin/settings.php') ?>" class="me-3 text-decoration-none"><i class="fa fa-cog"></i> Settings</a>
            <a href="<?php echo base_url('admin/logout.php') ?>" class="me-3 text-decoration-none"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-10 col-md-8 bg-home mx-auto p-4 rounded">
            <div class="row g-3">
                
               
            </div>
            
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>

       