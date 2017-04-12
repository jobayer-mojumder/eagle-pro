<?php
ob_start();
    session_start();
    session_destroy();
echo$_SESSION['username'];
echo$_SESSION['password'];
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['user_type']);
    header('Location: login.php');
?>