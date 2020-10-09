<?php
require_once(__DIR__ . "/../../require/connectDB.php");
$tableId = $_POST["tableId"];
$query = "SELECT check_in_id FROM check_in WHERE table_id=$tableId ORDER BY check_in_id DESC LIMIT 1";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_array($result)) {
    $check_in_id = $row["check_in_id"];
}
$query = "SELECT order_list_id,food_name,food_price,food_amount,food_cook FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$check_in_id";
$result = mysqli_query($conn, $query);
?>
<table class="table" id="cartTable">
    <thead>
        <tr>
            <th scope="col">ชื่ออาหาร</th>
            <th scope="col">จำนวน</th>
            <th scope="col">ราคาต่อหน่วย</th>
            <th scope="col">สถานะ</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody id="cart">
        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>

            <tr>
                <th scope="row"><?php echo $row["food_name"] ?></th>
                <td><?php echo $row["food_amount"] ?></td>
                <td><?php echo $row["food_price"] ?></td>
                <td>
                    <?php
                    if ($row['food_cook'] == 0) {
                        echo 'อยู่ในคิว';
                    } else if ($row['food_cook'] == 1) {
                        echo 'อยู่ระหว่างดำเนินการ';
                    } else if ($row['food_cook'] == 2) {
                        echo 'รอการเสิร์ฟ';
                    } else if ($row['food_cook'] == 3) {
                        echo 'เสร็จสิ้น';
                    } else if ($row['food_cook'] == 4) {
                        echo 'รายการถูกยกเลิก';
                    }
                    ?>


                </td>
                <td>
                    <?php
                    if ($row['food_cook'] == 0) {
                    ?>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteHistoryRecord(<?php echo $row['order_list_id']; ?>)">ยกเลิก</button>
                    <?php
                    }
                    ?>
                </td>

            <?php
        }
            ?>
            </tr>
    </tbody>
</table>