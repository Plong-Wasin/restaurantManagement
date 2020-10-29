s<?php
    include("../require/connectDB.php");
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $recommend = mysqli_real_escape_string($conn, $_POST["recommend"]);
    echo  $recommend;
    $sql_name = "UPDATE setting SET `value` = '$name' WHERE `name`='restaurant_name'";
    if (mysqli_query($conn, $sql_name)) {
        echo "name updated successfully";
        '<br>';
    } else {
        echo "Error name updating record: " . mysqli_error($conn);
    }

    $sql_recomment = "UPDATE setting SET `value` = '$recommend' WHERE `name`='recommend'";
    if (mysqli_query($conn, $sql_recomment)) {
        echo "date updated successfully";
        '<br>';
    } else {
        echo "Error date updating record: " . mysqli_error($conn);
    }


    if (basename($_FILES["fileToUpload"]["name"]) != "") {
        // $sql = "SELECT value FROM setting WHERE name='background'";
        // $result = mysqli_query($conn, $sql);
        // if (mysqli_num_rows($result) > 0) {
        //     // output data of each row
        //     while ($row = mysqli_fetch_array($result)) {
        //         unlink("../src/img/" . $row['value']);
        //     }
        // } 

        $target_dir = "../src/img/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $ext = end((explode(".", basename($_FILES["fileToUpload"]["name"]))));
        $filename = "logo." . $ext;
        $move_file = $target_dir . $filename;
        //echo $filename = basename($_FILES["fileToUpload"]["name"]);

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

        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }


        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>ไม่สามารถอัพโหลดไฟล์ได้.</script>";
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            $query = "SELECT `value` FROM setting WHERE name = 'background'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                unlink("../src/img/" . $row["value"]);
            }
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
    }
    echo '<script>alert("แก้ไขเรียบร้อยแล้ว")</script>';
    // header("location:./AdminScreenMain.php");
    ?> <script>
    window.onload = function() {
        window.top.location.reload();
    }
</script>