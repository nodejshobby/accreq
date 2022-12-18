<?php

// Prevent unauthenticated acccess
if(!isset($_SESSION['admin_auth_id'])){
    $_SESSION['info'] = "Log in to gain access";
    redirect(base_url('admin/login.php'));
}

?>