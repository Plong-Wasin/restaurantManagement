<?php
include("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["foodType"]);
$sql = "DELETE temp_order FROM temp_order INNER JOIN food ON food.food_id=temp_order.food_id WHERE food.food_type_id=$id";
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
$query = "SELECT food_image FROM food WHERE food_type_id=$id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    unlink("../../src/img/food/" . $row["food_image"]);
}
$sql2 = "DELETE FROM food WHERE food_type_id=" . $id;
if (mysqli_query($conn, $sql2)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
$sql = "DELETE FROM food_type WHERE food_type_id=" . $id;
//echo $id;

if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
