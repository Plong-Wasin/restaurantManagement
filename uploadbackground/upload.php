<?php
$target_dir = "../src/img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$ext = end((explode(".", basename($_FILES["fileToUpload"]["name"]))));
$move_file = $target_dir . "background." . $ext;
echo $filename = basename($_FILES["fileToUpload"]["name"]);
$filename = "background." . $ext;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
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


// Check file size
if ($_FILES["fileToUpload"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

include("../require/connectDB.php");
$query = "SELECT `value` FROM setting WHERE name = 'background'";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    unlink("../src/img/" . $row["value"]);
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $move_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        $sql1 = "UPDATE `setting` SET `value` = '$filename' WHERE `name` = 'background'";
        if (!mysqli_query($conn, $sql1)) {
            echo "Error updating record: " . mysqli_error($conn);
            //echo "Record deleted successfully";
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
