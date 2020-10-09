<?php
require_once(__DIR__ . "/../../require/connectDB.php");
if (!isset($_POST["data"])) {
    $_POST["data"] = "option1";
}
$sql = "SELECT check_in.check_in_id,check_in.paid_timestamp,check_in.check_in_timestamp,SUM(order_list.food_price*order_list.food_amount) AS total FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE order_list.food_cook=3 AND check_in.paid_timestamp IS NOT NULL AND ";
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
        $sql .= "DATE(check_in.paid_timestamp) > '$formDate' GROUP BY check_in.check_in_id ORDER BY check_in.paid_timestamp";
    } elseif ($toDate != "")
        $sql .= "DATE(check_in.paid_timestamp) < '$toDate' GROUP BY check_in.check_in_id ORDER BY check_in.paid_timestamp";
}
$result = mysqli_query($conn, $sql);
$total = 0;
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    // output data of each row
    while ($row = mysqli_fetch_array($result)) {
        $checkInId = $row['check_in_id'];
        $total = $total + $row['total'];
?>
        <tr onclick="showHideSubTable(<?php echo $i ?>)" style="cursor: pointer;">
            <td scope="row"><?php echo $i ?></td>
            <td><?php echo $row['check_in_timestamp'] ?></td>
            <td><?php echo $row['paid_timestamp'] ?></td>
            <td><?php echo number_format($row['total']) ?></td>
        </tr>

        <table class="table" style="display: none; padding-left: '50px';" id="subTable<?php echo $i ?>">
            <thead class="table-secondary">
                <tr>
                    <th>รายการอาหาร</th>
                    <th>จำนวน</th>
                    <th>ราคาต่อหน่วย(บาท)</th>
                </tr>
            </thead>
            <tbody class="table-dark">
                <?php
                $subSql = "SELECT order_list.food_name,order_list.food_price,order_list.food_amount FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$checkInId";
                $subResult = mysqli_query($conn, $subSql);
                if (mysqli_num_rows($subResult) > 0) {
                    // output data of each row
                    while ($subRow = mysqli_fetch_array($subResult)) {
                ?>
                        <tr>
                            <td scope="row"><?php echo $subRow['food_name'] ?> </td>
                            <td><?php echo $subRow['food_amount'] ?></td>
                            <td><?php echo $subRow['food_price'] ?></td>
                        </tr>
                <?php }
                } ?>
            </tbody>
        </table>

    <?php
        $i++;
    }
    ?>

<?php
}
//echo $sql;
?>
<script>
    $(document).ready(function() {
        var numTotal = <?php echo $total ?>;
        document.getElementById("total").innerText = numTotal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        if (document.getElementById("subTable" + subTable).style.display == "none") {
            document.getElementById("subTable" + subTable).style.display = "table"
        } else
            document.getElementById("subTable" + subTable).style.display = "none"
    }
</script>