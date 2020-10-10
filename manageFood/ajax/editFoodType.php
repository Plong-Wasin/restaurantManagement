<?php
//insert.php  
include("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$id = mysqli_real_escape_string($conn, $_POST["foodType"]);
$name = mysqli_real_escape_string($conn, $_POST["newFoodTypeName"]);

$query = "
    UPDATE food_type
    SET food_type_name = '$name'
    WHERE food_type_id = '$id';
    ";
if (mysqli_query($conn, $query)) {
    echo "Update success";
    echo $query;
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
