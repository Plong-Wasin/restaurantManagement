<?php
include("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["data"]);
$sql = "DELETE FROM temp_order WHERE food_id=" . $id;
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
$query = "SELECT food_image FROM food WHERE food_id=$id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    unlink("../../src/img/food/" . $row["food_image"]);
}
$sql = "DELETE FROM food WHERE food_id=" . $id;
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
