<?php
require_once("../../require/connectDB.php");
$foodId = $_POST['foodId'];
$sql = "SELECT food_have FROM food WHERE food_id = $foodId";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($result)) {
    echo $row['food_have'];
}
