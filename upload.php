<?php
session_start();
$target_dir = "tmp/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
// echo ("<br>$target_file<br>");
$uploadOk = 1;
$filename = basename($_FILES["fileToUpload"]["name"]);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sql";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
$one_kB = 1024;
$file_size_limit = 500 * $one_kB;
if ($_FILES["fileToUpload"]["size"] > $file_size_limit) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
if (
    $imageFileType != "jpg"
    && $imageFileType != "png"
    && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";

        if ($_SESSION["username"] == "holros") {
            $sql = "INSERT INTO uploads (filename, user, uploadtime, snuskig)
            VALUES ('$filename', '" . $_SESSION["username"] . "', NOW(), TRUE)";
            $conn->query($sql);
        } else {
            $sql = "INSERT INTO uploads (filename, user, uploadtime) VALUES ('$filename', '" . $_SESSION["username"] . "', NOW())";
            $result = $conn->query($sql);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }


    $mydata = fopen("tmp/mydata.txt", "a");
    $file = $_SESSION["username"] . ":" . $target_file . "\n";
    fwrite($mydata, $file);
}
