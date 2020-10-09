<?php
require_once("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["data"]);
$sql = "DELETE FROM temp_order WHERE temp_order_id=" . $id;
if (!mysqli_query($conn, $sql)) {
    echo "Error deleting record: " . mysqli_error($conn);
}
