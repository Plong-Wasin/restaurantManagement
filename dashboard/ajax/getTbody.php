<?php
require_once(__DIR__ . "/../../require/connectDB.php");
if (!isset($_POST["data"])) {
    $_POST["data"] = "option1";
}
if (!isset($_POST["topic"]))
    $_POST["topic"] = "ภาพรวม";
if ($_POST["topic"] == "ภาพรวม") {
    $sql = "SELECT check_in.paid_status,check_in.cash,check_in.check_in_id,check_in.paid_timestamp,check_in.check_in_timestamp,SUM(order_list.food_price*order_list.food_amount) AS total FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp IS NOT NULL AND ";
    if ($_POST["data"] == "option1")
        $sql .= "DATE(check_in.paid_timestamp)=CURDATE() GROUP BY check_in.check_in_id  ORDER BY check_in.paid_timestamp";
    elseif ($_POST["data"] == "option2")
        $sql .= "DATE(check_in.paid_timestamp) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() GROUP BY check_in.check_in_id  ORDER BY check_in.paid_timestamp";
    elseif ($_POST["data"] == "option3")
        $sql .= "MONTH(check_in.paid_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(check_in.paid_timestamp) = YEAR(CURRENT_DATE()) GROUP BY check_in.check_in_id  ORDER BY check_in.paid_timestamp";
    elseif ($_POST["data"] == "option4") {

        $formDate = $_POST["form"];
        $toDate = $_POST["to"];
        if ($formDate != "" && $toDate != "") {
            $sql .= "DATE(check_in.paid_timestamp) BETWEEN '$formDate' AND '$toDate' GROUP BY check_in.check_in_id ORDER BY check_in.paid_timestamp";
        } elseif ($formDate != "") {
            $sql .= "DATE(check_in.paid_timestamp) >= '$formDate' GROUP BY check_in.check_in_id ORDER BY check_in.paid_timestamp";
        } elseif ($toDate != "")
            $sql .= "DATE(check_in.paid_timestamp) <= '$toDate' GROUP BY check_in.check_in_id ORDER BY check_in.paid_timestamp";
    }
    $result = mysqli_query($conn, $sql);
    $total = 0;
    $realTotal = 0;
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $checkInId = $row['check_in_id'];
            $total = $total + $row['total'];
            if ($row["paid_status"] == 1) {
                $realTotal = $realTotal + $row['total'];
            }
?>
            <tr onclick="showHideSubTable(<?php echo $i ?>)" style="cursor: pointer;">
                <!-- <td scope="row"><?php echo $i ?></td> -->
                <td scope="row"><?php echo date_format(date_create($row['check_in_timestamp']), "d/m/Y H:i:s"); ?></td>
                <td><?php echo date_format(date_create($row['paid_timestamp']), "d/m/Y H:i:s"); ?></td>
                <td class="text-right"><?php echo number_format($row['total']) ?></td>
                <td class="text-right">
                    <?php if ($row["paid_status"] == 1) { ?>
                        <button type="button" class="btn btn-primary" onclick='window.open("../../Cashier/Cashier.db copy 2.php?checkInId=<?php echo $row["check_in_id"]; ?>&cash=<?php echo $row["cash"] ?>","_blank");'>ปริ้นใบเสร็จ</button>
                    <?php } elseif ($row["paid_status"] == 2) { ?>
                        <button type="button" class="btn btn-danger" onclick='window.open("../../Cashier/Cashier.db.roback.php?checkInId=<?php echo $row["check_in_id"]; ?>")'>ไปหน้าจ่ายเงิน</button>
                    <?php } ?>
                </td>
            </tr>
            <tr style="display: none;" class="subTable<?php echo $i ?> table-secondary">
                <th>รายการอาหารที่สั่ง</th>
                <th>จำนวน</th>
                <th class="text-right">ราคาต่อหน่วย(บาท)</th>
                <th class="text-right">ราคารวม(บาท)</th>
            </tr>
            <?php
            $subSql = "SELECT order_list.food_name,order_list.food_price,SUM(order_list.food_amount) as sumFood_amount FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$checkInId AND order_list.food_cook=3 GROUP BY order_list.food_id,order_list.food_price";
            $subResult = mysqli_query($conn, $subSql);
            if (mysqli_num_rows($subResult) > 0) {
                // output data of each row
                while ($subRow = mysqli_fetch_array($subResult)) {
            ?>
                    <tr style="display: none;" class="subTable<?php echo $i ?> table-info">
                        <td scope="row"><?php echo $subRow['food_name'] ?> </td>
                        <td><?php echo $subRow['sumFood_amount'] ?></td>
                        <td class="text-right"><?php echo number_format($subRow['food_price']) ?></td>
                        <td class="text-right"><?php echo number_format($subRow['food_price'] * $subRow['sumFood_amount']) ?></td>
                    </tr>
            <?php }
            } ?>
        <?php
            $i++;
        }
    }
} else {
    $sql = "SELECT check_in.paid_status,order_list.food_name,order_list.food_price,sum(order_list.food_amount) as sum_food_amount,sum(order_list.food_amount)*order_list.food_price AS total_price FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp IS NOT NULL AND ";
    if ($_POST["data"] == "option1")
        $sql .= "DATE(check_in.paid_timestamp)=CURDATE() ";
    elseif ($_POST["data"] == "option2")
        $sql .= "DATE(check_in.paid_timestamp) BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE() ";
    elseif ($_POST["data"] == "option3")
        $sql .= "MONTH(check_in.paid_timestamp) = MONTH(CURRENT_DATE()) AND YEAR(check_in.paid_timestamp) = YEAR(CURRENT_DATE()) ";
    elseif ($_POST["data"] == "option4") {
        $formDate = $_POST["form"];
        $toDate = $_POST["to"];
        if ($formDate != "" && $toDate != "") {
            $sql .= "DATE(check_in.paid_timestamp) BETWEEN '$formDate' AND '$toDate' ";
        } elseif ($formDate != "") {
            $sql .= "DATE(check_in.paid_timestamp) >= '$formDate' ";
        } elseif ($toDate != "")
            $sql .= "DATE(check_in.paid_timestamp) <= '$toDate' ";
    }
    $sql .= "GROUP BY check_in.paid_status,order_list.food_name,order_list.food_price ORDER BY order_list.food_name";
    $result = mysqli_query($conn, $sql);
    $total = 0;
    $realTotal = 0;
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            //$checkInId = $row['check_in_id'];
            $total = $total + $row['total_price'];
            if ($row["paid_status"] == 1) {
                $realTotal = $realTotal + $row['total_price'];
            }
        ?>
            <tr class="<?php if ($row["paid_status"] == 2) {
                            echo "text-danger";
                        } ?>" onclick="showHideSubTable(<?php echo $i ?>)" style="cursor: pointer;">
                <td scope="row"><?php echo $row["food_name"] ?></td>
                <td class="text-right"><?php echo number_format($row["food_price"]) ?></td>
                <td class="text-right"><?php echo number_format($row["sum_food_amount"]) ?></td>
                <td class="text-right"><?php echo number_format($row["total_price"]) ?></td>
            </tr>
            <tr style="display: none;" class="subTable<?php echo $i ?> table-secondary">
                <th colspan="2">วัน/เดือน/ปี</th>
                <th class="text-right">จำนวน</th>
                <th class="text-right">ราคารวม(บาท)</th>
            </tr>
            <?php
            $subSql = "SELECT order_list.food_name,DATE(check_in.paid_timestamp) AS paidDate,order_list.food_amount,order_list.food_amount*order_list.food_price AS total_price FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp  IS NOT NULL AND order_list.food_name='{$row["food_name"]}' AND check_in.paid_status='{$row["paid_status"]}' GROUP BY order_list.food_name,order_list.food_price,DATE(check_in.paid_timestamp)";
            $subResult = mysqli_query($conn, $subSql);
            if (mysqli_num_rows($subResult) > 0) {
                // output data of each row
                while ($subRow = mysqli_fetch_array($subResult)) {
            ?>
                    <tr style="display: none;" class="subTable<?php echo $i ?> table-info">
                        <td scope="row" colspan="2"><?php echo date_format(date_create($subRow["paidDate"]), "d/m/Y"); //echo date_format($subRow["paidDate"], "Y/m/d H:i:s");
                                                    ?></td>
                        <td class="text-right"><?php echo $subRow['food_amount'] ?></td>
                        <td class="text-right"><?php echo number_format($subRow['total_price']) ?></td>
                    </tr>
            <?php }
            } ?>
<?php
            $i++;
        }
    }
}
?>
<script>
    $(document).ready(function() {
        var numTotal = <?php echo $total ?>;
        document.getElementById("total").innerText = numTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var realNumTotal = <?php echo $realTotal ?>;
        document.getElementById("realTotal").innerText = realNumTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("toDate").setAttribute("max", today);
        document.getElementById("formDate").setAttribute("max", today);

    });

    function showHideSubTable(subTable) {
        if (document.getElementsByClassName("subTable" + subTable)[0].style.display == "none") {
            $(".subTable" + subTable).css("display", "table-row");
        } else
            $(".subTable" + subTable).css("display", "none");

    }
</script>