<?php session_start(); ?>
<?php
    $_SESSION['uname'] = null;
    $_SESSION['user_type'] = null;
    $_SESSION['hod_department'] = null;
        
    header('Location: login.php');
?>