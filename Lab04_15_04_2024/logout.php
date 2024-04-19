<?php
session_start();

if(isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}


if(isset($_COOKIE['user'])) {
    setcookie('user', '', time() - 3600);
}

header("Location: login.php");
exit;
?>
