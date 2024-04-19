<?php
session_start();

if(isset($_COOKIE['user']) && $_COOKIE['user'] === 'loggedin') {
    echo "Chào mừng bạn, người dùng!";
    echo "<br>";
    echo '<a href="logout.php">Đăng xuất</a>';
} else {
    header("Location: login.php");
    exit;
}
?>
