<?php
require_once("../../require/connectDB.php");
if (!empty($_POST)) {
    $output = '';
}
$tableId = $_POST["tableId"];
$foodId = mysqli_real_escape_string($conn, $_POST["foodId"]);
$foodAmount = mysqli_real_escape_string($conn, $_POST["foodAmount"]);
$query = "
    INSERT INTO temp_order(table_id,food_id,food_amount)  
     VALUES('$tableId','$foodId','$foodAmount')
    ";

if (mysqli_query($conn, $query)) {
    echo "New record created successfully";
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
