<?php
//insert.php  
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$name = mysqli_real_escape_string($conn, $_POST["foodTypeName"]);
$sql = "SELECT food_type_id FROM food_type WHERE food_type_name='$name'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "มีชื่อนี้อยู่แล้ว";
} else {
    $query = "
    INSERT INTO food_type(food_type_name)  
     VALUES('$name')
    ";
    if (!mysqli_query($conn, $query)) {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
