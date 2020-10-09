<?php
include("server.php");
$username = mysqli_real_escape_string($conn, $_POST["data"]);
$sql = "DELETE FROM users WHERE username= '$username'";
if (!mysqli_query($conn, $sql)) {
  echo "Error deleting record: " . mysqli_error($conn);
  //echo "Record deleted successfully";
}
