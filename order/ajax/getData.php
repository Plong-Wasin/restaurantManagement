<?php
require_once("../../require/connectDB.php");
$tableId = $_POST["tableId"];
$query = "SELECT temp_order.temp_order_id,food.food_name,temp_order.food_amount,food.food_price FROM temp_order INNER JOIN food ON temp_order.food_id = food.food_id WHERE table_id=$tableId";
$result = mysqli_query($conn, $query);
?>
<table class="table" id="cartTable">
    <thead>
        <tr>
            <th scope="col">ชื่ออาหาร</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคาต่อหน่วย</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="cart">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            //echo json_encode($row);
        ?>
            <tr>
                <th scope="row"><?php echo $row["food_name"] ?></th>
                <td><?php echo $row["food_amount"] ?></td>
                <td><?php echo $row["food_price"] ?></td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm" value="<?php echo $row["temp_order_id"] ?>" onclick="deleteOrder(<?php echo $row['temp_order_id'] ?>)">ยกเลิก</button>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
<div class="text-right">
    <button type="button" id="confirmOrder" class="btn btn-primary" onclick="callAjaxConfirmOrder();">ยืนยันการสั่ง</button>
</div>