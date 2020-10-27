<?php
require_once(__DIR__ . "/../../require/connectDB.php");
if (isset($_POST['foodTypeId'])) {
    $foodTypeId = $_POST['foodTypeId'];
} else {
    $foodTypeId = $firstFoodType;
}
?>

<?php
if ($foodTypeId != 0)
    $food_query = "SELECT * FROM food WHERE food_type_id=" . $foodTypeId . " ORDER BY  food_have DESC, food_name ASC";
else
    $food_query = "SELECT * FROM food WHERE food_recommend=1 ORDER BY food_name ASC";
$food_result = mysqli_query($conn, $food_query);
while ($row = mysqli_fetch_array($food_result)) {
?>
    <tr>
        <td scope="row" class="text-center"><img id="img_<?php echo $row["food_id"]; ?>" onclick="enlarge('img_<?php echo $row['food_id']; ?>')" src="<?php if ($row["food_image"] != null) echo "../src/img/food/" . $row["food_image"];
                                                                                                                                                        else echo "../src/img/1200px-No_image_available.svg.png" ?>" height="auto" width="auto" style="max-height: 200px;" class="img-thumbnail" /></td>
        <td><?php echo $row["food_name"] ?></td>
        <td><?php echo $row["food_price"] ?></td>
        <?php
        if ($row["food_have"] == 1) {
        ?>
            <td><button class="btn btn-primary" val="<?php echo $row["food_id"] ?>" onclick="orderFood('<?php echo $row['food_id'] ?>','<?php echo $row['food_name'] ?>',<?php echo $row['food_price'] ?>);" data-toggle="modal" data-target="#modalOrder">สั่งอาหาร</button></td>
        <?php
        } else {
        ?>
            <td><button class="btn btn-secondary" disabled val="<?php echo $row["food_id"] ?>">อาหารหมด</button></td>

        <?php
        }
        ?>
    </tr>
<?php
}

?>