<?php
require_once("../../../require/connectDB.php");
$json = json_encode($_POST["data"]);
$json_array  = json_decode($_POST["data"], true);
for ($i = 0; $i < count($json_array); $i++) {
    echo $json_array[$i]["id"];
    if ($json_array[$i]["checked"]) {
        $checked = 1;
    } else {
        $checked = 0;
    }
    $sql = "UPDATE food SET food_recommend=$checked WHERE food_id={$json_array[$i]["id"]}";
    if (!mysqli_query($conn, $sql)) {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
