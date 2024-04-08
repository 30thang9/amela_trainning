<?php
$isValidEmail = true;
$fullName = $email = $message = "";
$isSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $isSubmitted = true;
    $fullName = $_POST["fullName"];

    $email = $_POST["email"];
    if (!validateEmail($email)) {
        $isValidEmail = false;
    }

    $message = $_POST["message"];
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
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css" integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="w-75 mx-auto pt-4">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row">
            <div class="form-group col-md-6 mb-3">
                <label for="fullName" class="form-label">Full Name:</label>
                <input type="text" name="fullName" id="fullName" class="form-control" value="<?php echo htmlspecialchars($fullName ?? ''); ?>">
            </div>
            <div class="form-group col-md-6 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($email ?? ''); ?>">
                <?php echo $isValidEmail ? '' : '<div class="text-danger mt-2">Email is not in correct format</div>';?>
            </div>
            <div class="form-group col-12 mb-3">
                <label for="message" class="form-label">Message:</label>
                <textarea name="message" id="message" class="form-control"><?php echo htmlspecialchars($message ?? ''); ?></textarea>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    <?php if ($isSubmitted && $isValidEmail ): ?>
        <div class="alert mt-5 alert-success" role="alert">
            Message sent successfully!
        </div>
    <?php endif; ?>
</div>
</body>
</html>
