<?php
session_start();

if(isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: admin.php");
    exit;
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === 'admin' && $password === 'password') {
        $_SESSION['admin'] = true;

        header("Location: admin.php");
        exit;
    } else {
        echo "Thông tin đăng nhập không đúng.";
    }
}

if(isset($_COOKIE['user']) && $_COOKIE['user'] === 'loggedin') {
    header("Location: user.php");
    exit;
}

if(isset($_POST['submit_user'])) {
    setcookie('user', 'loggedin', time() + (15 * 24 * 60 * 60));
    header("Location: user.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập</title>
</head>
<body>
<h2>Đăng nhập cho admin</h2>
<form method="POST">
    <input type="text" name="username" placeholder="Tên đăng nhập"><br>
    <input type="password" name="password" placeholder="Mật khẩu"><br>
    <button type="submit" name="submit">Đăng nhập</button>
</form>

<h2>Đăng nhập cho người dùng</h2>
<form method="POST">
    <button type="submit" name="submit_user">Đăng nhập (15 ngày)</button>
</form>
</body>
</html>
