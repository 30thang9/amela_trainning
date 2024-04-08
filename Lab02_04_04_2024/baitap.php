<?php
$nameErr = $phoneErr = $emailErr = $passwordErr = $ageErr = $addressErr = $occupationErr = "";
$name = $phone = $email = $occupation = $password = $age = $address = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Tên không được để trống";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-ZÀ-ỹ ]*$/",$name)) {
            $nameErr = "Chỉ chấp nhận ký tự và khoảng trắng";
        }
    }

    if (empty($_POST["phone"])) {
        $phoneErr = "Số điện thoại không được để trống";
    } else {
        $phone = test_input($_POST["phone"]);
        if (!preg_match("/^[0-9]*$/",$phone)) {
            $phoneErr = "Chỉ chấp nhận số";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email không được để trống";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Định dạng email không hợp lệ";
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password không được để trống";
    }
    else{
        $password = test_input($_POST["password"]);
        if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            $passwordErr = "Password cần ít nhất 8 ký tự, bao gồm ít nhất 1 ký tự số, 1 ký tự chữ hoa, 1 ký tự chữ thường và 1 ký tự đặc biệt";
        }
    }

    if (!empty($_POST["age"])) {
        $age = test_input($_POST["age"]);
        if (!preg_match("/^[0-9]*$/",$age)) {
            $ageErr = "Chỉ chấp nhận số";
        }
    }

    if (!empty($_POST["address"])) {
        $address = test_input($_POST["address"]);
    }

    if (!empty($_POST["occupation"])) {
        $occupation = test_input($_POST["occupation"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thành viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .error {color: red;}
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Đăng ký thành viên
                </div>
                <div class="card-body">
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($nameErr) && empty($phoneErr) && empty($emailErr) && empty($passwordErr) && empty($ageErr) && empty($addressErr) && empty($occupationErr)) : ?>
                        <h4>Thông tin đã nhập:</h4>
                        <p>Tên: <?php echo $name; ?></p>
                        <p>Tuổi: <?php echo $age; ?></p>
                        <p>Địa chỉ: <?php echo $address; ?></p>
                        <p>Số điện thoại: <?php echo $phone; ?></p>
                        <p>Email: <?php echo $email; ?></p>
                        <p>Nghề nghiệp: <?php echo $occupation; ?></p>
                        <p>Password: <?php echo str_repeat('*', strlen($password)); ?></p>
                    <?php else: ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="name">Tên:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>">
                                <span class="error"><?php echo $nameErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="age">Tuổi:</label>
                                <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($age); ?>">
                                <span class="error"><?php echo $ageErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>">
                                <span class="error"><?php echo $addressErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                                <span class="error"><?php echo $phoneErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                                <span class="error"><?php echo $emailErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="occupation">Nghề nghiệp:</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($occupation); ?>">
                                <span class="error"><?php echo $occupationErr;?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="error"><?php echo $passwordErr;?></span>
                            </div>
                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
