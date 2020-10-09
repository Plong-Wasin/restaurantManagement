<?php
include("../../require/connectDB.php");
$orderid = mysqli_real_escape_string($conn, $_POST["data"]);
$qu = mysqli_real_escape_string($conn, $_POST["data1"]);
$sql = "UPDATE order_list SET food_cook=3 WHERE order_list_id=$orderid";
if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
