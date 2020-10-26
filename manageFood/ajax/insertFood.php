<?php
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$id = $_POST["foodID"];
$name = mysqli_real_escape_string($conn, $_POST["foodName"]);
$price = mysqli_real_escape_string($conn, $_POST["foodPrice"]);
$type = mysqli_real_escape_string($conn, $_POST["foodType"]);

$sql = "SELECT food_id FROM food WHERE food_name='$name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo 'มีชื่อนี้อยู่แล้ว';
} else {
    if (isset($_POST['imageName'])) {
        $imageName = mysqli_real_escape_string($conn, $_POST["imageName"]);
        $query = "SELECT food_image FROM food WHERE food_id=$id";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {
            if ($row['food_image'] != null) {
                if ($row['food_image'] != $imageName) {
                    unlink("../../src/img/food/" . $row["food_image"]);
                }
            }
        }
    }
    if ($id == "") {
        if (isset($_POST['imageName'])) {
            $query = "
        INSERT INTO food(food_name,food_price,food_type_id,food_image)  
         VALUES('$name','$price','$type','$imageName')
        ";
        } else {
            $query = "
        INSERT INTO food(food_name,food_price,food_type_id)  
         VALUES('$name','$price','$type')
        ";
        }
    } else {
        if (isset($_POST['imageName'])) {
            $query = "
            UPDATE food
            SET food_name = '$name', food_price= '$price',food_type_id='$type', food_image= '$imageName'
            WHERE food_id = '$id';
            ";
        } else {
            $query = "
        UPDATE food
        SET food_name = '$name', food_price= '$price',food_type_id='$type'
        WHERE food_id = '$id';
        ";
        }
    }
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
