<?php
if (!isset($_SESSION)) {
    session_start();
}
//echo $_SESSION['role'];
require_once(__DIR__ . "/../../../require/connectDB.php");
if (isset($_POST['foodTypeId'])) {
    $foodTypeId = $_POST['foodTypeId'];
} else
    $foodTypeId = $firstFoodType;
?>
<?php
$food_query = "SELECT * FROM food WHERE food_type_id=" . $foodTypeId . " ORDER BY food_name ASC";
$food_result = mysqli_query($conn, $food_query);
while ($row = mysqli_fetch_array($food_result)) {
?>
    <tr>
        <td>
            <input type="checkbox" class="checkbox" name="" id="ids[]" value="<?php echo $row["food_id"] ?>" <?php if ($row["food_recommend"]) echo "checked"; ?>>
        </td>
        <td scope="row" class="text-center"><img id="img_<?php echo $row["food_id"]; ?>" onclick="enlarge('img_<?php echo $row['food_id']; ?>')" src="<?php if ($row["food_image"] != null) echo "../../src/img/food/" . $row["food_image"];
                                                                                                                                                        else echo "../../src/img/1200px-No_image_available.svg.png" ?>" height="auto" width="auto" style="max-height: 200px;" class="img-thumbnail" /></td>
        <td><?php echo $row["food_name"] ?></td>
        <td><?php echo number_format($row['food_price']) ?></td>
    </tr>
    </tr>
<?php
}
?>