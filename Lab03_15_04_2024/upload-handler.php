<?php
$target_dir = "assets/images/banner/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$original_filename = $_FILES["fileToUpload"]["name"];
$extension = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
$new_filename = uniqid() . '.' . $extension; // Tạo tên mới ngẫu nhiên
$target_file = $target_dir . $new_filename;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$isCreateNew = false;

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
    $isCreateNew = $_POST['option'] === 'c';
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["fileToUpload"]["size"] > (1024 * 1024 * 5)) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png") {
    echo "Sorry, only JPG, PNG files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
