<?php
include("../../require/connectDB.php");
$number = mysqli_real_escape_string($conn, $_POST["numberTableDeleted"]);
$sql = "DELETE FROM `table` ORDER BY table_id DESC LIMIT " . $number;
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
