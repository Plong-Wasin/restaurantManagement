<?php
require_once("../../require/connectDB.php");
$tableId = $_POST["tableId"];
$query = "SELECT check_in_id FROM check_in WHERE table_id=$tableId ORDER BY check_in_id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $check_in_id = $row["check_in_id"];
}
$query = "
    INSERT INTO order_time(check_in_id)  
     VALUES('$check_in_id')
    ";

if (mysqli_query($conn, $query)) {
    $last_order_time_id = mysqli_insert_id($conn);
    $query = "SELECT temp_order.food_id,food.food_name,food.food_price,temp_order.food_amount FROM food INNER JOIN temp_order ON food.food_id = temp_order.food_id WHERE temp_order.table_id=" . $tableId;
    $result = mysqli_query($conn, $query);
    $query2 = "
    INSERT INTO order_list(order_time_id,food_id,food_name,food_price,food_amount)  
     VALUES('";
    while ($row = mysqli_fetch_array($result)) {
        $food_id = $row['food_id'];
        $food_name = $row['food_name'];
        $food_price = $row['food_price'];
        $food_amount = $row['food_amount'];
        $query2 .= "$last_order_time_id','$food_id','$food_name','$food_price','$food_amount'),('";
    }
    $query2 = trim($query2, ",('");
    if (mysqli_query($conn, $query2)) {
        $sql = "DELETE FROM temp_order WHERE table_id=$tableId";
        if (!mysqli_query($conn, $sql)) {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {

    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
