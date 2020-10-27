<?php
//insert.php  
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$id = mysqli_real_escape_string($conn, $_POST["foodType"]);
$name = mysqli_real_escape_string($conn, $_POST["newFoodTypeName"]);
$sql = "SELECT food_type_id FROM food_type WHERE food_type_name='$name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    echo "มีชื่อนี้อยู่แล้ว";
    exit();
}
$query = "
    UPDATE food_type
    SET food_type_name = '$name'
    WHERE food_type_id = '$id';
    ";
if (!mysqli_query($conn, $query)) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
