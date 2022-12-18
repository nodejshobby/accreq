<?php
session_start();

// Require Files and Functions
require_once 'functions.php';

?>
<?php include_once 'includes/header.php'; ?>

<?php 
    // Include Logo design file
    include_once 'includes/logo.php';
?>

<!-- Form Box -->
<div class="container">
            <div class="row">
                <div class="col-11 col-md-8 col-lg-6 justify-content-center align-items-center m-auto p-4 py-5 rounded bg-home shadow-sm">
                    <h2 class="text-white fw-bold text-center mb-4">Fill in this form</h2>
                    
                    <!-- Dispay success message -->
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

                    <form action="<?php echo base_url('process.php'); ?>" method="post">
                        <div class="form-group mb-3">
                            <input class="form-control" name="name" type="text" placeholder="Your Name" aria-label="Name" value="<?php if(getInput('name')) { echo getInput('name'); }?>">
                            <?php if(getError('name')) {  ?>
                                <em class="text-yellow"><?php echo getError('name') ?></em>
                            <?php } ?>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" name="email" type="text" placeholder="Your Email" value="<?php if(getInput('email')) { echo getInput('email'); }?>" aria-label="Email">
                            <?php if(getError('email')) {  ?>
                                <em class="text-yellow"><?php echo getError('email') ?></em>
                            <?php } ?>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" name="phone_number" type="text" placeholder="Phone Number" value="<?php if(getInput('phone_number')) { echo getInput('phone_number'); }?>" aria-label="Phone">
                            <?php if(getError('phone')) {  ?>
                                <em class="text-yellow"><?php echo getError('phone') ?></em>
                            <?php } ?>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <select name="type" class="form-select" aria-label="Accomodation Type">
                                        <option selected>Select a type</option>
                                        <option value="Single Room" <?php if (getInput('type') == "Single Room") { echo "selected"; } ?>>Single Room</option>
                                        <option value="Self-contained" <?php if (getInput('type') == "Self-contained") { echo "selected"; } ?>>Self-contained</option>
                                        <option value="Flat" <?php if (getInput('type') == "Flat") { echo "selected"; } ?>>Flat</option>
                                        <option value="Hostel" <?php if (getInput('type') == "Hostel") { echo "selected"; } ?>>Hostel</option>
                                    </select>
                                    <?php if(getError('type')) {  ?>
                                        <em class="text-yellow"><?php echo getError('type') ?></em>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select name="roomate" class="form-select" aria-label="Roomate">
                                        <option selected>Select Roomate</option>
                                        <option value="none" <?php if (getInput('roomate') == "none") { echo "selected"; } ?>>none</option>
                                        <option value="1" <?php if (getInput('roomate') == "1") { echo "selected"; } ?>>1</option>
                                        <option value="2" <?php if (getInput('roomate') == "2") { echo "selected"; } ?>>2</option>
                                    </select>
                                    <?php if(getError('roomate')) {  ?>
                                        <em class="text-yellow"><?php echo getError('roomate') ?></em>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-group">
                                    <select name="institution" class="form-select" aria-label="Level">
                                        <option selected>Select Institution</option>
                                        <option value="none" <?php if (getInput('institution') == "none") { echo "selected"; } ?>>none</option>
                                        <option value="OAU" <?php if (getInput('institution') == "OAU") { echo "selected"; } ?>>OAU</option>
                                        <option value="OUI" <?php if (getInput('institution') == "OUI") { echo "selected"; } ?>>OUI</option>
                                    </select>
                                    <?php if(getError('institution')) {  ?>
                                        <em class="text-yellow"><?php echo getError('institution') ?></em>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <select name="level" class="form-select" aria-label="Level">
                                        <option selected>Select Level</option>
                                        <option value="none" <?php if (getInput('level') == "none") { echo "selected"; } ?>>none</option>
                                        <option value="100" <?php if (getInput('level') == "100") { echo "selected"; } ?>>100</option>
                                        <option value="200" <?php if (getInput('level') == "200") { echo "selected"; } ?>>200</option>
                                        <option value="300" <?php if (getInput('level') == "300") { echo "selected"; } ?>>300</option>
                                        <option value="400" <?php if (getInput('level') == "400") { echo "selected"; } ?>>400</option>
                                        <option value="500" <?php if (getInput('level') == "500") { echo "selected"; } ?>>500</option>
                                        <option value="600" <?php if (getInput('level') == "600") { echo "selected"; } ?>>600</option>
                                    </select>
                                    <?php if(getError('level')) {  ?>
                                        <em class="text-yellow"><?php echo getError('level') ?></em>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        
                       
                        
                        <div class="form-group mb-3">
                            <input class="form-control" name="budget" type="text" placeholder="Budget" value="<?php if(getInput('budget')) { echo getInput('budget'); }?>" aria-label="Budget">
                            <?php if(getError('budget')) {  ?>
                                <em class="text-yellow"><?php echo getError('budget') ?></em>
                            <?php } ?>
                        </div>

                        <div class="form-group mb-4">
                            <input class="form-control" name="location" type="text" placeholder="Preffered  Location" value="<?php if(getInput('location')) { echo getInput('location'); }?>" aria-label="Preferred Location">
                        </div>

                        <div class="form-group text-center">
                            <input class="btn btn-warning bg-yellow fw-bold request-btn" name="request" type="submit" value="Request Now" aria-label="Request">
                        </div>
                        
                    </form>
                    <div class="text-center mt-3">
                        <small class="text-info">*Please enter your correct details as this helps us in proper matchmaking*</small>
                    </div>
                </div>
            </div>
</div>
<?php include_once "includes/footer.php"; ?>

       