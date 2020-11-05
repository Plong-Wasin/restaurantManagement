<?php
include('../Session/Check_Session.php');
include("../require/connectDB.php");
if (isset($_POST["data"])) {
    $table = mysqli_real_escape_string($conn, $_POST["data"]);
}
if (isset($_GET["checkInId"])) {
    $checkInId = $_GET["checkInId"];
}
?>
</head>

<body>
    <?php
    $totalFood_amount = 0;
    $totalPrice = 0;
    $change = 0;
    $cash = 0;
    ?>
    <div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100">
                    <div id="spanusers">
                        <table>
                            <thead>
                                <tr class="table100-head">
                                    <th>ชื่ออาหาร</th>
                                    <th>จำนวน</th>
                                    <th>ราคา(ต่อหนึ่งรายการ)</th>
                                    <th>ราคา(ทั้งหมด)</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <?php

                                if (isset($_POST["data"])) {
                                    $checkIn = "SELECT * FROM `check_in` WHERE table_id = $table and paid_timestamp is NULL ";
                                    $check = mysqli_query($conn, $checkIn);
                                    while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
                                        $checkInId = $record['check_in_id'];
                                        $tableId = $record['table_id'];
                                    }
                                }
                                if (isset($_GET["checkInId"])) {
                                    $checkIn = "SELECT * FROM `check_in` WHERE check_in_id = '$checkInId'";
                                    $check = mysqli_query($conn, $checkIn);
                                    while ($record = mysqli_fetch_array($check, MYSQLI_ASSOC)) {
                                        $checkInId = $record['check_in_id'];
                                        $tableId = 0;
                                    }
                                }
                                $subSql = "SELECT order_list.food_name,order_list.food_price,SUM(order_list.food_amount) as sumFood_amount FROM check_in INNER JOIN order_time ON check_in.check_in_id=order_time.check_in_id INNER JOIN order_list ON order_time.order_time_id = order_list.order_time_id WHERE check_in.check_in_id=$checkInId AND order_list.food_cook=3 GROUP BY order_list.food_id,order_list.food_price";
                                $subResult = mysqli_query($conn, $subSql);
                                while ($subRow = mysqli_fetch_array($subResult, MYSQLI_ASSOC)) {
                                    echo "<tr>";
                                    echo "<td>" . $subRow['food_name'] . "</td>";
                                    echo "<td>" . $subRow['sumFood_amount'] . "</td>";
                                    echo "<td>" . number_format($subRow['food_price']) . "</td>";
                                    echo "<td>" . number_format($subRow['sumFood_amount'] * $subRow['food_price']) . "</td>";
                                ?>
                                    <?php echo '</tr>'; ?>
                                <?php
                                    $totalFood_amount =  $totalFood_amount + $subRow['sumFood_amount'];
                                    $totalPrice =   $totalPrice + $subRow['sumFood_amount'] * $subRow['food_price'];
                                }
                                ?>
                                <tr>
                                    <td>รวม</td>
                                    <td><?php echo $totalFood_amount ?></td>
                                    <td>---</td>
                                    <td><?php echo number_format($totalPrice) ?></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="background: #36304a;text-align: center;font-size: 20px;color: white;">คิดเงิน</td>
                                </tr>
                                <tr>
                                    <td>เงินสด(เว้นเมื่อไม่มีการจ่ายเงิน)</td>
                                    <td colspan="3" style="text-align: center;"> <input class="cash" id=cash type="text" name="text_plain" onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}" onchange="cal(<?php echo $totalPrice ?>)" style="
    align-items: center;
    text-align: right;
    line-height: 45px;
    background: gainsboro;
    box-shadow: inset 0px 1px 3px 0px rgba(0, 0, 0, 0.08);
    border-radius: 5px;
    font-size: 16px;
    color: #666;
    transition: all 0.4s ease;
    padding-right: 10px;" required onchange="check(<?php $totalPrice ?>)" /></td>

                                </tr>
                            </tbody>
                        </table>
                        <tr>
                            <div id=cal>
                            </div>
                        </tr>

                    </div>
                </div>
                <table style="width: 200px;">
                    <tr>
                        <td> <button class="CheckBin" onclick="CheckBin(<?php echo $checkInId ?> , <?php echo $tableId ?> )">คิดเงิน</button></td>
                        <td> <button class="printBin" onclick="window.open('./PrintBinV1.php?checkInId=<?php echo $checkInId; ?>', '_blank');">พิมพ์ใบเก็บเงิน</button></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <?php
    $_SESSION['check_in_id'] = $checkInId;
    ?>

    <script>
        function CheckBin(checkInId, tableId) {
            if (<?php echo $totalPrice ?> > document.getElementById("cash").value && document.getElementById("cash").value != 0) {
                alert("จำนวนเงินไม่ถูกต้อง");
            } else {
                if (confirm("ยืนยัน")) {
                    $.ajax({
                        url: "./Cashier_db/CheckBin.php",
                        method: "POST",
                        data: {
                            data: checkInId,
                            data1: tableId,
                            data2: document.getElementById("cash").value,

                        },
                        success: function(data) {
                            alert("คิดเงินเสร็จสิ้น");
                            //alert(data);
                            location.reload('./CashierScreen.php');
                        }
                    });
                    if (document.getElementById("cash").value != 0) {
                        window.open("./PrintBinV2.php?checkInId=" + checkInId + "&cash=" + document.getElementById("cash").value, '_blank');
                    }
                }
            }
        }

        // function PrintBin(checkInId, tableId, cash) {
        //     $n = cash;
        //     if (confirm("ยืนยัน"))
        //         $.ajax({
        //             url: "./Cashier_db/PrintBin.php",
        //             method: "POST",
        //             data: {
        //                 data: checkInId,
        //                 data1: tableId,

        //             },
        //             success: function(data) {
        //                 window.open("./Cashier_db/PrintBin.php");
        //             }
        //         });
        // }

        src = "https://code.jquery.com/jquery-3.5.1.min.js"

        function cal(totalPrice) {
            if (document.getElementById("cash").value < totalPrice) {
                alert("จำนวนเงินสดไม่ถูกต้อง");
            } else {
                $.ajax({
                    url: "./Cashier_db/Cal.php",
                    method: "POST",
                    data: {
                        data: totalPrice,
                        data1: document.getElementById("cash").value,
                    },
                    success: function(data) {
                        $("#cal").html(data);
                    }
                });
            }
        }
    </script>