<?php
include("../../require/connectDB.php");
$ordertimeid = mysqli_real_escape_string($conn, $_POST["data"]);
$foodcookall = mysqli_real_escape_string($conn, $_POST["data1"]);
$query5 = "SELECT order_time_id,food_cook,order_list_id FROM `order_list` WHERE order_time_id = $ordertimeid and food_cook = $foodcookall";
$ree1 = mysqli_query($conn, $query5);
if ($foodcookall == 2) {
    while ($ree = mysqli_fetch_array($ree1, MYSQLI_ASSOC)) {
        $ss = $ree['order_list_id'];
        $sql1 = "UPDATE order_list SET food_cook=3 WHERE order_list_id = $ss";
        if ($conn->query($sql1) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}
