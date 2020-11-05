<?php
include("../../require/connectDB.php");
$username = mysqli_real_escape_string($conn, $_POST["data"]);
echo $username;
$sql1 = "UPDATE users SET date_leavework = current_timestamp() WHERE username = '$username'";
if (!mysqli_query($conn, $sql1)) {
  echo "Error UPDATE record: " . mysqli_error($conn);
  //echo "Record deleted successfully";
}

$sql2 = "UPDATE users SET `status`= 0 WHERE username = '$username'";
if (!mysqli_query($conn, $sql2)) {
  echo "Error UPDATE record: " . mysqli_error($conn);
  //echo "Record deleted successfully";
}
