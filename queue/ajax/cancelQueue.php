<?php
include("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$sql = "DELETE FROM queue WHERE queue_id=" . $id;
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
