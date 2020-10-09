<?php
include("../../require/connectDB.php");
$id = mysqli_real_escape_string($conn, $_POST["id"]);
$query = "
    UPDATE queue
    SET queue_in_timestamp = CURRENT_TIMESTAMP()
    WHERE queue_id = '$id';
    ";
if (mysqli_query($conn, $query)) {
    echo "successfully";
} else {
    echo "Error : " . mysqli_error($conn);
}
