<?php
$isValidFN = true;
$isValidLN = true;
$isValidEmail = true;
$isValidPass = true;
$isValidCPass = true;
$firstName = $lastName = $email = $password = $confirmPassword = "";
$registrationSuccess = false;
$isSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isSubmitted = true;
    $firstName = $_POST["firstName"];
    if (empty($firstName)) {
        $isValidFN = false;
    }

    $lastName = $_POST["lastName"];
    if (empty($lastName)) {
        $isValidLN = false;
    }

    $email = $_POST["email"];
//    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//        $isValidEmail = false;
//    }
    if (!validateEmail($email)) {
        $isValidEmail = false;
    }

    $password = $_POST["password"];
    if (strlen($password) < 8) {
        $isValidPass = false;
    }

    $confirmPassword = $_POST["confirmPassword"];
    if ($password !== $confirmPassword) {
        $isValidCPass = false;
    }

    if ($isValidFN && $isValidLN && $isValidEmail && $isValidPass && $isValidCPass) {
        $registrationSuccess = true;
    }
}

function validateEmail($email) {
    $v = "/[a-z0-9]+@[a-z]+\.[a-z]{2,3}/";
    return (bool)preg_match($v, $email);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="w-75 mx-auto pt-4">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row">
            <div class="form-group col-md-6 mb-3">
                <label for="firstName" class="form-label">First Name:</label>
                <input type="text" name="firstName" id="firstName" class="form-control" value="<?php echo htmlspecialchars($firstName ?? ''); ?>">
                <?php echo $isValidFN ? '' : '<div class="text-danger mt-2">First Name must contain at least 1 character</div>';?>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="lastName" class="form-label">Last Name:</label>
                <input type="text" name="lastName" id="lastName" class="form-control" value="<?php echo htmlspecialchars($lastName ?? ''); ?>">
                <?php echo $isValidLN ? '' : '<div class="text-danger mt-2">Last Name must contain at least 1 character</div>';?>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <?php echo $isValidEmail ? '' : '<div class="text-danger mt-2">Email is not in correct format</div>';?>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($password ?? '');?>">
                <?php echo $isValidPass ? '' : '<div class="text-danger mt-2">Password must be at least 8 characters long</div>';?>
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="confirmPassword" class="form-label">Confirm Password:</label>
                <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" value="<?php echo htmlspecialchars($confirmPassword ?? '');?>">
                <?php echo $isValidCPass ? '' : '<div class="text-danger mt-2">Confirm password does not match password</div>';?>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </form>

    <?php if ($registrationSuccess): ?>
        <div class="alert alert-success mt-5" role="alert">
            Registration successful!
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo htmlspecialchars($firstName); ?></td>
                <td><?php echo htmlspecialchars($lastName); ?></td>
                <td><?php echo htmlspecialchars($email); ?></td>
            </tr>
            </tbody>
        </table>
    <?php else: ?>
    <?php endif; ?>
</div>
</body>
</html>
