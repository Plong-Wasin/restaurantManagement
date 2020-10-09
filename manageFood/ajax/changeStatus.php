<?php
require_once("../../require/connectDB.php");
$food_id = $_POST['food_id'];
$food_have = !$_POST['food_have'];
$query = "
UPDATE food
SET food_have='$food_have'
WHERE food_id = '$food_id';
";
if ($food_have == 0) {
    $sql = "DELETE FROM temp_order WHERE food_id=$food_id";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    }
    $sql = "UPDATE order_list SET food_cook=4 WHERE food_id=$food_id AND food_cook=0";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
if (mysqli_query($conn, $query)) {
    echo $query;
    echo "Update successfully";
?>

<?php
} else {
?>

<?php
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}
