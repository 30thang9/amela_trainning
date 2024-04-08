<!DOCTYPE html>
<html>
<head>
    <title>Log Viewer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .log-entry {
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<h2>Log Viewer</h2>
<?php
$logfile = "assets/log.txt";

if (file_exists($logfile)) {
    $handle = fopen($logfile, "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            echo '<div class="log-entry">' . nl2br($line) . '</div>';
        }
        fclose($handle);
    } else {
        echo "Unable to open log file for reading.";
    }
} else {
    echo "Log file does not exist or could not be found.";
}
?>
</body>
</html>
