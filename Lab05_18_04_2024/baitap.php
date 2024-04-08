<?php
$errors = [];
$data = [
        'name' => '',
        'phone' => '',
        'email' => '',
        'password' => '',
        'age' => '',
        'address' => '',
        'occupation' => ''
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fields = ['name', 'phone', 'email', 'password', 'age', 'address', 'occupation'];

    foreach ($fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst($field) . " không được để trống";
        } else {
            $data[$field] = test_input($_POST[$field]);
        }
    }

    if (empty($errors['name']) && !preg_match("/^[a-zA-ZÀ-ỹ ]*$/",$data['name'])) {
        $errors['name'] = "Chỉ chấp nhận ký tự và khoảng trắng";
    }

    if (empty($errors['phone']) && !preg_match("/^[0-9]*$/",$data['phone'])) {
        $errors['phone'] = "Chỉ chấp nhận số";
    }

    if (empty($errors['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Định dạng email không hợp lệ";
    }

    if (empty($errors['password'])) {
        $password = $data['password'];
        if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password) || !preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
            $errors['password'] = "Password cần ít nhất 8 ký tự, bao gồm ít nhất 1 ký tự số, 1 ký tự chữ hoa, 1 ký tự chữ thường và 1 ký tự đặc biệt";
        }
    }

    if (!empty($data['age']) && !preg_match("/^[0-9]*$/",$data['age'])) {
        $errors['age'] = "Chỉ chấp nhận số";
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
                    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && empty(array_filter($errors))) : ?>

                        <?php
                        $servername = "mysql";
                        $username = "root";
                        $password = "";
                        $dbname = "lab5";

                        try {
                            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);

                            $stmt = $conn->prepare("INSERT INTO users (name, phone, email, password, age, address, occupation) VALUES (:name, :phone, :email, :password, :age, :address, :occupation)");
                            $stmt->bindParam(':name', $data['name']);
                            $stmt->bindParam(':phone', $data['phone']);
                            $stmt->bindParam(':email', $data['email']);
                            $stmt->bindParam(':password', $hashed_password);
                            $stmt->bindParam(':age', $data['age']);
                            $stmt->bindParam(':address', $data['address']);
                            $stmt->bindParam(':occupation', $data['occupation']);

                            $stmt->execute();

                            echo "Dữ liệu đã được thêm thành công vào cơ sở dữ liệu.";
                        } catch(PDOException $e) {
                            echo "Có lỗi xảy ra khi thêm dữ liệu vào cơ sở dữ liệu: " . $e->getMessage();
                        }

                        $conn = null;
                        ?>

                        <h4>Thông tin đã nhập:</h4>
                        <p>Tên: <?php echo $data['name']; ?></p>
                        <p>Tuổi: <?php echo $data['age']; ?></p>
                        <p>Địa chỉ: <?php echo $data['address']; ?></p>
                        <p>Số điện thoại: <?php echo $data['phone']; ?></p>
                        <p>Email: <?php echo $data['email']; ?></p>
                        <p>Nghề nghiệp: <?php echo $data['occupation']; ?></p>
                        <p>Password: <?php echo str_repeat('*', strlen($data['password'])); ?></p>
                    <?php else: ?>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="form-group">
                                <label for="name">Tên:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($data['name']); ?>">
                                <span class="error"><?php echo $errors['name'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="age">Tuổi:</label>
                                <input type="text" class="form-control" id="age" name="age" value="<?php echo htmlspecialchars($data['age']); ?>">
                                <span class="error"><?php echo $errors['age'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($data['address']); ?>">
                                <span class="error"><?php echo $errors['address'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="phone">Số điện thoại:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($data['phone']); ?>">
                                <span class="error"><?php echo $errors['phone'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                                <span class="error"><?php echo $errors['email'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="occupation">Nghề nghiệp:</label>
                                <input type="text" class="form-control" id="occupation" name="occupation" value="<?php echo htmlspecialchars($data['occupation']); ?>">
                                <span class="error"><?php echo $errors['occupation'] ?? ''; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password">
                                <span class="error"><?php echo $errors['password'] ?? ''; ?></span>
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
