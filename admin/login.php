<?php
session_start();

// Require Files and Functions
require_once '../functions.php';

?>
<?php include_once 'includes/header.php'; ?>

<?php 
    // Include Logo design file 
    include_once 'includes/logo.php';
?>

<?php 

if(isset($_SESSION['admin_auth_id'])){
    redirect(base_url('admin'));
}

?>

<!-- Form Box -->
<div class="container">
            <div class="row">
                <div class="col-11 col-md-8 col-lg-6 justify-content-center align-items-center m-auto p-4 py-5 rounded bg-home shadow-sm">
                    <h2 class="text-white fw-bold text-center mb-4">Login as Administrator</h2>

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

                    <form action="<?php echo base_url('admin/process.php'); ?>" method="post">

                        <div class="form-group mb-3">
                            <input class="form-control" name="email" type="text" placeholder="Your Email" value="<?php if(getInput('email')) { echo getInput('email'); }?>" aria-label="Email">
                            <?php if(getError('email')) {  ?>
                                <em class="text-yellow"><?php echo getError('email') ?></em>
                            <?php } ?> 
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" name="password" type="password" placeholder="Password"  aria-label="Password">
                            <?php if(getError('password')) {  ?>
                                <em class="text-yellow"><?php echo getError('password') ?></em>
                            <?php } ?>
                        </div>
                    
                        <div class="form-group text-center">
                            <input class="btn btn-warning bg-yellow fw-bold request-btn" name="login" type="submit" value="Login" aria-label="Request">
                        </div>
                        
                     </form>
                </div>
            </div>
</div>

<?php include_once "includes/footer.php"; ?>

       