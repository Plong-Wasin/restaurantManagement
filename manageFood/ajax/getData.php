<?php
include("../../require/connectDB.php");
$id = $_POST["data"];
$query = "SELECT * FROM food WHERE food_id=$id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
echo json_encode($row);
