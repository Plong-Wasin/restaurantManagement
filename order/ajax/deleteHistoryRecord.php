<?php
require_once("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["order_list_id"]);
$sql = "DELETE FROM order_list WHERE order_list_id=" . $id;
if (!mysqli_query($conn, $sql)) {
    echo "Error deleting record: " . mysqli_error($conn);
}
