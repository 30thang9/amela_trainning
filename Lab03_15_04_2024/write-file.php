<?php
if(isset($_POST['log_message'])) {
    $message = $_POST['log_message'];
    $logfile = "assets/log.txt";

    $myfile = fopen($logfile, "a") or die("Unable to open file!");

    $txt = "[" . date("Y-m-d H:i:s") . "] " . $message . "\n";
    fwrite($myfile, $txt);

    fclose($myfile);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Log Message</title>
</head>
<body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="log_message">Enter log message:</label><br>
    <textarea id="log_message" name="log_message" rows="4" cols="50"></textarea><br>
    <button type="submit">Log Message</button>
</form>
</body>
</html>
