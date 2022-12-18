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
            <div class="container">
                <div class="row">
                     <h2 class="text-white fw-bold text-center mb-4">Change your password</h2>

                    <!-- Display success message -->
                    <?php if(!empty($_SESSION['success'])) { ?>
                        <div class="alert alert-success">
                            <?php echo $_SESSION['success']; ?>
                        </div>
                    <?php } ?>
                    
                    <!-- Display error message -->
                    <?php if(!empty($_SESSION['error'])) { ?>
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                    <?php } ?>

                    <!-- Display info message -->
                    <?php if(!empty($_SESSION['info'])) { ?>
                        <div class="alert alert-info">
                            <?php echo $_SESSION['info']; ?>
                        </div>
                    <?php } ?>

                    <form action="<?php echo base_url('admin/processPassword.php'); ?>" method="post">

                        <div class="form-group mb-3">
                            <input class="form-control" name="old_password" type="password" placeholder="Old Password" aria-label="Old Password">
                            <?php if(getError('old_password')) {  ?>
                                <em class="text-yellow"><?php echo getError('old_password') ?></em>
                            <?php } ?> 
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" name="password" type="password" placeholder="New Password" >
                            <?php if(getError('password')) {  ?>
                                <em class="text-yellow"><?php echo getError('password') ?></em>
                            <?php } ?> 
                        </div>

                        <div class="form-group mb-3">
                            <input class="form-control" name="confirm_password" type="password" placeholder="Confirm Password"  aria-label="Confirm Password">
                            <?php if(getError('confirm_password')) {  ?>
                                <em class="text-yellow"><?php echo getError('confirm_password') ?></em>
                            <?php } ?>
                        </div>
                    
                        <div class="form-group text-center">
                            <input class="btn btn-warning bg-yellow fw-bold request-btn" name="update" type="submit" value="Update" aria-label="Update">
                        </div>
                        
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once "includes/footer.php"; ?>

       