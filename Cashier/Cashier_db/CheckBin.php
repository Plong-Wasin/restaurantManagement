<?php
include("../../require/connectDB.php");
$CheckInID = mysqli_real_escape_string($conn, $_POST["data"]);
$tableID = mysqli_real_escape_string($conn, $_POST["data1"]);
$paid_status = mysqli_real_escape_string($conn, $_POST["data2"]);
$query1 = "SELECT order_list_id FROM `order_list` INNER JOIN order_time on order_list.order_time_id=order_time.order_time_id INNER JOIN check_in ON order_time.check_in_id = check_in.check_in_id WHERE  table_id = $tableID AND food_cook !=3 and paid_timestamp IS NULL";
$result1 = mysqli_query($conn, $query1);
$o = 0;
if ($o = 1) {
    while ($re = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        $n = $re['order_list_id'];
        $sql = "DELETE FROM order_list WHERE order_list_id= $n";
        if (!mysqli_query($conn, $sql)) {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo "Record deleted successfully";
        }
    }
    $sql1 = "UPDATE check_in SET paid_timestamp=current_timestamp() WHERE check_in_id=$CheckInID";
    if (!mysqli_query($conn, $sql1)) {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo "Record deleted successfully";
    }

    $sql1 = "UPDATE `table` SET table_status = 0 WHERE check_in_id = $CheckInID";
    if (!mysqli_query($conn, $sql1)) {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo "Record deleted successfully";
    }

    $sql2 = "DELETE FROM temp_order WHERE table_id= $tableID";
    if (!mysqli_query($conn, $sql2)) {
        echo "Error deleting record: " . mysqli_error($conn);
        //echo "Record deleted successfully";
    }
    if ($paid_status == 0) {
        $sql1 = "UPDATE `check_in` SET paid_status = 2 WHERE check_in_id = $CheckInID";
        if (!mysqli_query($conn, $sql1)) {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo "Record deleted successfully";
        }
    } else {
        $sql1 = "UPDATE `check_in` SET paid_status = 1 WHERE check_in_id = $CheckInID";
        if (!mysqli_query($conn, $sql1)) {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo "Record deleted successfully";
        }
        $sql1 = "UPDATE `check_in` SET cash = $paid_status WHERE check_in_id = $CheckInID";
        if (!mysqli_query($conn, $sql1)) {
            echo "Error deleting record: " . mysqli_error($conn);
            //echo "Record deleted successfully";
        }
    }
}
