<?php include(__DIR__ . '/../../require/connectDB.php');
$order = "SELECT order_time.order_time_id,check_in.table_id,food_cook FROM `order_list` INNER JOIN order_time on order_list.order_time_id=order_time.order_time_id INNER JOIN check_in ON order_time.check_in_id = check_in.check_in_id WHERE food_cook = 2  
ORDER BY `order_time`.`order_time_id` ASC";
$result = mysqli_query($conn, $order);
$skip = 0;
while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) { ?>
    <?php
    if ($skip != $record['order_time_id']) {
    ?>
        <div class="limiter">
            <div class="container-table100">
                <div class="wrap-table100">
                    <div class="table100">
                        <div id="spanusers">
                            <?php $select = $record['order_time_id'];
                            ?>
                            <table>
                                <p style="text-align: center;font-family: 'Raleway',sans-serif;font-size: 35px;font-weight: 800;line-height: 72px;text-align: center;text-transform: uppercase;">โต๊ะที่<?php echo $record['table_id'] ?> (ออเดอร์<?php echo $record['order_time_id'] ?>)</p>
                                <table>
                                    <thead>
                                        <tr class="table100-head">
                                            <th>ชื่ออาหาร</th>
                                            <th>จำนวน</th>
                                            <div class="get">
                                                <th><button type="button" class="food_cookall_0" onclick="food_cookall(<?php echo $select . ',' . 2 ?> )">เสริฟทั้งหมด</button></th>
                                            </div>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <?php
                                        $query1 = "SELECT * FROM `order_list` WHERE `order_time_id` = $select and food_cook = 2 ORDER BY `order_list`.`order_time_id` ASC";
                                        $result1 = mysqli_query($conn, $query1);
                                        while ($re = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                                            echo "<tr>";
                                            echo "<td>" . $re['food_name'] . "</td>";
                                            echo "<td>" . $re['food_amount'] . "</td>";
                                            echo "<td>"; ?>
                                            <button type="button" class="food_cook_0" onclick="food_cook(<?php echo $re['order_list_id'] . ',' . $re['food_cook'] ?> )">เสริฟ</button>
                                        <?php "</td>";

                                            echo '</tr>';
                                        }

                                        ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
        $skip = $record['order_time_id'];
    }
}

?>
<script>
    function food_cook(orderlistid, foodcook) {
        $.ajax({
            url: "./Service_db/ServiceUpdate.php",
            method: "POST",
            data: {
                data: orderlistid,
                data1: foodcook
            },
            success: function(data) {
                test();
            }
        })
    }

    function food_cookall(ordertimeid, foodcookALL) {
        $.ajax({
            url: "./Service_db/ServiceUpdateAll.php",
            method: "POST",
            data: {
                data: ordertimeid,
                data1: foodcookALL
            },
            success: function(data) {
                test();
            }
        })
    }
</script>