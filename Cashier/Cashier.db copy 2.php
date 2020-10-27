<?php
include('../Session/Check_Session.php');
include("../require/connectDB.php");
include_once("../require/req.php");

$getCheckInId = $_GET["checkInId"];
$casha = $_GET["cash"]; ?>

<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>
    <?php
    $totalFood_amount = 0;
    $totalPrice = 0;
    $change = 0;
    $cash = 0;
    $db1 = "SELECT * FROM `check_in` WHERE `check_in_id` = '$getCheckInId'";
    $check2 = mysqli_query($conn, $db1);
    while ($record2 = mysqli_fetch_array($check2, MYSQLI_ASSOC)) {
        $code = $record2['code'];
        $table = $record2['table_id'];
    }
    $db = "SELECT * FROM `setting` WHERE `name` = 'background'";
    $check1 = mysqli_query($conn, $db);
    while ($record1 = mysqli_fetch_array($check1, MYSQLI_ASSOC)) {
        $logo = $record1['value'];
    }
    $sql = "SELECT value FROM setting WHERE name='restaurant_name'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_array($result)) {
            $name_res = $row["value"];
        }
    }
    ?>
    <div style="width: 320px;padding: 5px;  margin: 20px;">
        <div>
            <h1 style="text-align: center;"><a class="logo"><img src="../src/img/<?php echo $logo ?>" width="100" height="100"></a></h1>
            <h4 style="text-align: center;">ใบเรียกเก็บเงิน</h4>
            <table>
                <tr>
                    <th style="font-size: 20px;">
                        ร้าน<?php echo $name_res ?>
                    </th>
                </tr>
                <tr>
                    <td>รหัสลูกค้า:<?php echo $code ?></td>
                    <td style="padding-left: 60px;">โต๊ะที่:<?php echo $table ?></td>
                </tr>
                <tr>
                    <td><?php echo "วันที่:" . date("d/m/Y"); ?></td>
                    <?php date_default_timezone_set("Asia/Bangkok"); ?>
                    <td style="padding-left: 25px;">เวลา:<?php echo date("H:i:s"); ?></td>
                </tr>
            </table>
            <table>
                <tr style="    border-top-style: solid;    border-bottom-style: solid;">
                    <th colspan="3" style="width: 180px;">รายการ</th>
                    <th style="width: 50px;">ราคา </th>
                    <th>รวม</th>
                </tr>

                <?php
                $checkIn = "SELECT * FROM `check_in` WHERE check_in_id = $getCheckInId ";
                $check = mysqli_query($conn, $checkIn);
                while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
                    $checkInId = $record['check_in_id'];
                    $tableId = $record['table_id'];
                }
                $subSql = "SELECT order_list.food_name,order_list.food_price,SUM(order_list.food_amount) as sumFood_amount FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$checkInId AND order_list.food_cook=3 GROUP BY order_list.food_id,order_list.food_price";
                $subResult = mysqli_query($conn, $subSql);
                while ($subRow = mysqli_fetch_array($subResult, MYSQLI_ASSOC)) {
                    echo "<tr>";
                    echo "<td colspan='3'>" . $subRow['food_name'] . " x " . $subRow['sumFood_amount'] . "</td>";
                    echo "<td>" . number_format($subRow['food_price']) . "</td>";
                    echo "<td>" . number_format($subRow['sumFood_amount'] * $subRow['food_price']) . "</td>";
                ?>
                    <?php echo '</tr>'; ?><?php
                                            $totalFood_amount =  $totalFood_amount + $subRow['sumFood_amount'];
                                            $totalPrice =   $totalPrice + $subRow['sumFood_amount'] * $subRow['food_price'];
                                        }
                                        $test =  $casha - $totalPrice;
                                            ?>
            </table>
            <table>
                <tr style="border-top-style: solid;">
                    <th style="text-align: right; width: 180px">รวม</th>
                    <th style="text-align: right; width: 90px; border-bottom-style: solid;"><?php echo number_format("$totalPrice", 2) . "<br>"; ?></th>
                </tr>
                <tr>
                    <th style="text-align: right; width: 180px">รวมทั้งสิ้น</th>
                    <th style="text-align: right;width: 90px;border-bottom-style: double;font-size: 25px;border-width: 10px;"><?php echo number_format("$totalPrice", 2) . "<br>"; ?></th>
                </tr>
                <tr>
                    <th style="text-align: right; width: 180px">เงินสด</th>
                    <th style="text-align: right;width: 90px;border-bottom-style: solid;font-size: 16px;border-width: 1px;"><?php echo number_format("$casha", 2) . "<br>"; ?></th>
                </tr>
                <tr>
                    <th style="text-align: right; width: 180px">เงินทอน</th>
                    <th style="text-align: right;width: 90px;border-bottom-style: solid;font-size: 20px;border-width: 1px;"><?php echo $test .  "<br>"; ?></th>
                </tr>
            </table>
            <table>
                <tr style="margin-top: 5px;">
                    <th style="text-align: center;width: 270px; " colspan='2'>*****ขอขอบคุณ*****<br>***ลูกค้าผู้มีอุปการะคุณทุกท่าน***<br>*ที่มาอุดหนุนทางร้านด้วยดีตลอดมา*</th>
                </tr>
            </table>
        </div>
    </div>
    <script>
        src = "https://code.jquery.com/jquery-3.5.1.min.js"
        $(document).ready(function() {
            window.print();
            setTimeout(() => {
                window.close();
            }, 1000);
        });
    </script>
</body>