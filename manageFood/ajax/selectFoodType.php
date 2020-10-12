<?php
require_once(__DIR__ . "/../../require/connectDB.php");
if (isset($_POST['foodTypeId']))
    $foodTypeId = $_POST['foodTypeId'];
else
    $foodTypeId = $firstFoodType;
?>
<?php
$food_query = "SELECT * FROM food WHERE food_type_id=" . $foodTypeId . " ORDER BY food_name ASC";
$food_result = mysqli_query($conn, $food_query);
while ($row = mysqli_fetch_array($food_result)) {
?>
    <tr>
        <td scope="row" class="text-center"><img src="<?php if ($row["food_image"] != null) echo "../src/img/food/" . $row["food_image"];
                                                        else echo "../src/img/1200px-No_image_available.svg.png" ?>" height="auto" width="auto" style="max-height: 200px;" class="img-thumbnail" /></td>
        <td><?php echo $row["food_name"] ?></td>
        <td><?php echo number_format($row['food_price']) ?></td>
        <td class="text-center"><?php if ($row["food_have"]) {
                                    echo 'มี';
                                } else {
                                    echo 'หมด';
                                }
                                ?>
        </td>
        <td>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <span class="px-1"><button type="button" class="btn btn-info" value="<?php echo $row["food_id"] ?>" onclick="editFood(<?php echo $row['food_id'] ?>)" data-toggle="modal" data-target="#insertFood">แก้ไข</button></span>
            <?php
            }
            ?>
            <span class="px-1"><button type="button" class="btn btn-success" value="<?php echo $row["food_id"] ?>" onclick="changeStatus(<?php echo $row['food_id'] . ',' . $row['food_have'] ?>)">เปลี่ยนสถานะ</button></span>
            <?php
            if ($_SESSION['role'] == 'admin') {
            ?>
                <span class="px-1"><button type="button" class="btn btn-danger" value="<?php echo $row["food_id"] ?>" onclick="deleteFood(<?php echo $row['food_id'] ?>)">ลบ</button></span>
            <?php
            }
            ?>
        </td>
    </tr>
    </tr>
<?php
}
?>