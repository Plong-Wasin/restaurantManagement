<?php
//insert.php  
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$name = mysqli_real_escape_string($conn, $_POST["foodTypeName"]);
$query = "
    INSERT INTO food_type(food_type_name)  
     VALUES('$name')
    ";
if (!mysqli_query($conn, $query)) {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
