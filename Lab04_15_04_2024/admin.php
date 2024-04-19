<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    echo "Chào mừng bạn, admin!";
    echo "<br>";
    echo '<a href="logout.php">Đăng xuất</a>';
} else {
    header("Location: login.php");
    exit;
}
?>

