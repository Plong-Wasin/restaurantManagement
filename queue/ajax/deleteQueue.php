<?php
include("../../require/connectDB.php");
if ($_POST["mode"] == 1) {
    $sql = "DELETE FROM queue ";
} else {
    $sql = "DELETE FROM queue WHERE queue_in_timestamp IS NOT NULL";
}
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
